<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PragmaRX\Tracker\Support\Minutes;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;
use PragmaRX\Tracker\Vendor\Laravel\Models\Error;

class StatsController extends Controller
{

    public function showOverview() {
        $devices = $this->getDevicesViews();
        $l7days = $this->get7DaysLogs();

        $logs = array_merge($l7days, $devices);

        return view('backend.group.stats.overview')->with($logs);
    }

    public function showView() {
        abort(404);
    }

    public function showError() {
        abort(404);
    }

    private function get7DaysLogs() {
        $range = new Minutes();
        $range->setStart(Carbon::now()->subDays(7));
        $range->setEnd(Carbon::now());

        $the404error = Error::where('code', '404')->first();
        $errors = Tracker::errors($range, false)
            ->where('error_id', '<>', $the404error->id)->take(15)->get();

        $visits = Tracker::pageViews(60 * 24 * 30);
        $unique_visits = DB::select(
            DB::raw(
                "SELECT date, count(*) as total 
                FROM (SELECT DATE(created_at) AS date, session_id FROM `tracker_log` GROUP BY DATE(created_at), session_id) AS t1
                GROUP BY date")
        );

        $visits_dates = [];
        $visits_counts = [];
        foreach ($visits as $visit) {
            array_push($visits_dates, $visit->date);
            array_push($visits_counts, $visit->total);
        }
        $unique_visits_counts = [];
        foreach ($unique_visits as $visit) {
            array_push($unique_visits_counts, $visit->total);
        }

        return [
            "errors" => $errors,
            "visits_dates" => $visits_dates,
            "visits_counts" => $visits_counts,
            "unique_visits_counts" => $unique_visits_counts
        ];
    }

    private function getDevicesViews() {
        $devices = DB::table('tracker_log')
            ->join('tracker_sessions', 'tracker_sessions.id', '=', 'tracker_log.session_id')
            ->join('tracker_devices', 'tracker_devices.id', '=', 'tracker_sessions.device_id')
            ->select(DB::raw('kind, count(*) as device_count'))
            ->groupBy('kind')
            ->get();

        $devices_labels = [];
        $devices_counts = [];
        foreach ($devices as $device) {
            array_push($devices_labels, $device->kind);
            array_push($devices_counts, $device->device_count);
        }

        return [
            "devices_labels" => $devices_labels,
            "devices_counts" => $devices_counts
        ];
    }

}
