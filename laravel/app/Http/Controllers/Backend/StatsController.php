<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use PragmaRX\Tracker\Support\Minutes;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;
use PragmaRX\Tracker\Vendor\Laravel\Models\Error;

class StatsController extends Controller
{

    public function showOverview() {
        // Policies Check
        if (Auth::user()->can('view_stats')) {
            return redirect()->route('view.backend.index')->with('status', 'backend_not_enough_permission_to_view_stats');
        }

        // Log from 7 days past
        $range = new Minutes();
        $range->setStart(Carbon::now()->subDays(7));
        $range->setEnd(Carbon::now());

        $devices = $this->getDevicesViews($range);
        $visits = $this->getVisits($range);
        $errors = $this->getErrors($range);

        $logs = array_merge($visits, $devices, $errors);

        return view('backend.group.stats.overview')->with($logs);
    }

    public function showView() {
        // Policies Check
        if (Auth::user()->can('view_stats')) {
            return redirect()->route('view.backend.index')->with('status', 'backend_not_enough_permission_to_view_stats');
        }

        abort(404);
    }

    public function showError() {
        // Policies Check
        if (Auth::user()->can('view_stats')) {
            return redirect()->route('view.backend.index')->with('status', 'backend_not_enough_permission_to_view_stats');
        }

        abort(404);
    }

    const SKIP_ERROR_REPORT = ['404'];

    private function getErrors(Minutes $range) {
        $skipErrors = Error::whereIn('code', self::SKIP_ERROR_REPORT)->pluck('id')->all();
        $errors = Tracker::errors($range, false)->whereNotIn('error_id', $skipErrors)->take(15)->get();

        return [
            "errors" => $errors,
        ];
    }

    private function getVisits(Minutes $range) {
        $visits = DB::select(
            DB::raw(
                "SELECT DATE(created_at) AS date, count(*) AS total 
                FROM `tracker_log`
                WHERE created_at >= :start AND created_at <= :end
                AND error_id IS NULL
                GROUP BY DATE(created_at)"),
            [
                "start" => $range->getStart(),
                "end" => $range->getEnd()
            ]
        );
        $unique_visits = DB::select(
            DB::raw(
                "SELECT date, count(*) as total 
                FROM (
                  SELECT DATE(created_at) AS date, session_id
                  FROM `tracker_log` 
                  WHERE created_at >= :start AND created_at <= :end
                  AND error_id IS NULL
                  GROUP BY DATE(created_at), session_id
                ) AS t1
                GROUP BY date"),
            [
                "start" => Carbon::now()->subDays(7),
                "end" => Carbon::now()
            ]
        );

        return [
            "visits_dates" => array_pluck($visits, 'date'),
            "visits_counts" => array_pluck($visits, 'total'),
            "unique_visits_counts" => array_pluck($unique_visits, 'total')
        ];
    }

    private function getDevicesViews(Minutes $range) {
        $devices = DB::table('tracker_log')
            ->join('tracker_sessions', 'tracker_sessions.id', '=', 'tracker_log.session_id')
            ->join('tracker_devices', 'tracker_devices.id', '=', 'tracker_sessions.device_id')
            ->select(DB::raw('kind, count(*) as device_count'))
            ->where('tracker_log.created_at', '>=', $range->getStart())
            ->where('tracker_log.created_at', '<=', $range->getEnd())
            ->whereNull('tracker_log.error_id')
            ->groupBy('kind')
            ->get();

        return [
            "devices_labels" => array_pluck($devices, 'kind'),
            "devices_counts" => array_pluck($devices, 'device_count')
        ];
    }

}
