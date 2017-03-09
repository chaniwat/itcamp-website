<?php

namespace App\Http\Controllers\Backend;

use App\Applicant;
use App\Camp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        return $this->showRegisterDashboard();
    }

    public function showRegisterDashboard() {
        #region HUGE QUERIES

        $applicant = Applicant::all();
        $applicant_count = $applicant->count() == 0 ? 1 : $applicant->count();

        $camp_app = Camp::where('name', 'camp_app')->first();
        $camp_app_boy = DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $camp_app->id)
            ->where('applicant_detail_key_id', 'sex')
            ->where('answer', '{"value": "male"}')
            ->groupBy('applicant_id')
            ->first();
        $camp_app_girl = DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $camp_app->id)
            ->where('applicant_detail_key_id', 'sex')
            ->where('answer', '{"value": "female"}')
            ->groupBy('applicant_id')
            ->first();
        $camp_app_approve = DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $camp_app->id)
            ->whereIn('applicants.state', array('CHECKED', 'CONFIRM', 'SELECT', 'RESERVE', 'FAIL'))
            ->groupBy('applicant_id')
            ->first();
        
        $camp_game = Camp::where('name', 'camp_game')->first();
        $camp_game_boy = DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $camp_game->id)
            ->where('applicant_detail_key_id', 'sex')
            ->where('answer', '{"value": "male"}')
            ->groupBy('applicant_id')
            ->first();
        $camp_game_girl = DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $camp_game->id)
            ->where('applicant_detail_key_id', 'sex')
            ->where('answer', '{"value": "female"}')
            ->groupBy('applicant_id')
            ->first();
        $camp_game_approve = DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $camp_game->id)
            ->whereIn('applicants.state', array('CHECKED', 'CONFIRM', 'SELECT', 'RESERVE', 'FAIL'))
            ->groupBy('applicant_id')
            ->first();
        
        $camp_network = Camp::where('name', 'camp_network')->first();
        $camp_network_boy = DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $camp_network->id)
            ->where('applicant_detail_key_id', 'sex')
            ->where('answer', '{"value": "male"}')
            ->groupBy('applicant_id')
            ->first();
        $camp_network_girl = DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $camp_network->id)
            ->where('applicant_detail_key_id', 'sex')
            ->where('answer', '{"value": "female"}')
            ->groupBy('applicant_id')
            ->first();
        $camp_network_approve = DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $camp_network->id)
            ->whereIn('applicants.state', array('CHECKED', 'CONFIRM', 'SELECT', 'RESERVE', 'FAIL'))
            ->groupBy('applicant_id')
            ->first();
        
        $camp_iot = Camp::where('name', 'camp_iot')->first();
        $camp_iot_boy = DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $camp_iot->id)
            ->where('applicant_detail_key_id', 'sex')
            ->where('answer', '{"value": "male"}')
            ->groupBy('applicant_id')
            ->first();
        $camp_iot_girl = DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $camp_iot->id)
            ->where('applicant_detail_key_id', 'sex')
            ->where('answer', '{"value": "female"}')
            ->groupBy('applicant_id')
            ->first();
        $camp_iot_approve = DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $camp_iot->id)
            ->whereIn('applicants.state', array('CHECKED', 'CONFIRM', 'SELECT', 'RESERVE', 'FAIL'))
            ->groupBy('applicant_id')
            ->first();
        
        $camp_datasci = Camp::where('name', 'camp_datasci')->first();
        $camp_datasci_boy = DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $camp_datasci->id)
            ->where('applicant_detail_key_id', 'sex')
            ->where('answer', '{"value": "male"}')
            ->groupBy('applicant_id')
            ->first();
        $camp_datasci_girl = DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $camp_datasci->id)
            ->where('applicant_detail_key_id', 'sex')
            ->where('answer', '{"value": "female"}')
            ->groupBy('applicant_id')
            ->first();
        $camp_datasci_approve = DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $camp_datasci->id)
            ->whereIn('applicants.state', array('CHECKED', 'CONFIRM', 'SELECT', 'RESERVE', 'FAIL'))
            ->groupBy('applicant_id')
            ->first();

        $boy = DB::table('applicant_applicant_detail_key')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('applicant_detail_key_id', 'sex')
            ->where('answer', '{"value": "male"}')
            ->groupBy('applicant_id')
            ->first();
        $girl = DB::table('applicant_applicant_detail_key')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('applicant_detail_key_id', 'sex')
            ->where('answer', '{"value": "female"}')
            ->groupBy('applicant_id')
            ->first();

        $checked = $applicant->whereIn('state', array('CHECKED', 'CONFIRM', 'SELECT', 'RESERVE', 'FAIL', 'REJECT'))->count();
        $approve = $applicant->whereIn('state', array('CHECKED', 'CONFIRM', 'SELECT', 'RESERVE', 'FAIL'))->count();

        #endregion

        $data = [
            "count" => [
                "app" => [
                    "total" => $camp_app->applicants->count(),
                    "boy" => $camp_app_boy ? $camp_app_boy->applicant_count : 0,
                    "girl" => $camp_app_girl ? $camp_app_girl->applicant_count : 0,
                    "approve" => $camp_app_approve ? $camp_app_approve->applicant_count : 0,
                ],
                "game" => [
                    "total" => $camp_game->applicants->count(),
                    "boy" => $camp_game_boy ? $camp_game_boy->applicant_count : 0,
                    "girl" => $camp_game_girl ? $camp_game_girl->applicant_count : 0,
                    "approve" => $camp_game_approve ? $camp_game_approve->applicant_count : 0,
                ],
                "network" => [
                    "total" => $camp_network->applicants->count(),
                    "boy" => $camp_network_boy ? $camp_network_boy->applicant_count : 0,
                    "girl" => $camp_network_girl ? $camp_network_girl->applicant_count : 0,
                    "approve" => $camp_network_approve ? $camp_network_approve->applicant_count : 0,
                ],
                "iot" => [
                    "total" => $camp_iot->applicants->count(),
                    "boy" => $camp_iot_boy ? $camp_iot_boy->applicant_count : 0,
                    "girl" => $camp_iot_girl ? $camp_iot_girl->applicant_count : 0,
                    "approve" => $camp_iot_approve ? $camp_iot_approve->applicant_count : 0,
                ],
                "datasci" => [
                    "total" => $camp_datasci->applicants->count(),
                    "boy" => $camp_datasci_boy ? $camp_datasci_boy->applicant_count : 0,
                    "girl" => $camp_datasci_girl ? $camp_datasci_girl->applicant_count : 0,
                    "approve" => $camp_datasci_approve ? $camp_datasci_approve->applicant_count : 0,
                ],
                "checked" => $checked,
                "approve" => $approve,
                "boy" => $boy ? $boy->applicant_count : 0,
                "girl" => $girl ? $girl->applicant_count : 0,
                "total" => $applicant_count
            ]
        ];

        return view('backend.group.dashboard.register')->with($data);
    }

    public function showOverviewDashboard() {
        /*
         * Overview dashboard
         * count selected & reserve applicant's (each camp), count shirt size
         * count confirm applicant
         */

        abort(404);
    }
}
