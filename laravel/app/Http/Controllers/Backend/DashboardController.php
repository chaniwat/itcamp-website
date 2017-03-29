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

        $applicant_count = Applicant::getApplicantCount();
        $male_count = Applicant::getMaleCount();
        $female_count = Applicant::getFemaleCount();
        $checked_count = Applicant::getCheckedCount();
        $approved_count = Applicant::getApprovedCount();

        /** @var Camp $camp_app */
        $camp_app = Camp::where('name', 'camp_app')->first();
        /** @var Camp $camp_game */
        $camp_game = Camp::where('name', 'camp_game')->first();
        /** @var Camp $camp_network */
        $camp_network = Camp::where('name', 'camp_network')->first();
        /** @var Camp $camp_iot */
        $camp_iot = Camp::where('name', 'camp_iot')->first();
        /** @var Camp $camp_datasci */
        $camp_datasci = Camp::where('name', 'camp_datasci')->first();

        $data = [
            "count" => [
                "app" => [
                    "total" => $camp_app->getApplicantCount(),
                    "boy" => $camp_app->getApplicantMaleCount(),
                    "girl" => $camp_app->getApplicantFemaleCount(),
                    "approve" => $camp_app->getApplicantApprovedCount(),
                ],
                "game" => [
                    "total" => $camp_game->getApplicantCount(),
                    "boy" => $camp_game->getApplicantMaleCount(),
                    "girl" => $camp_game->getApplicantFemaleCount(),
                    "approve" => $camp_game->getApplicantApprovedCount(),
                ],
                "network" => [
                    "total" => $camp_network->getApplicantCount(),
                    "boy" => $camp_network->getApplicantMaleCount(),
                    "girl" => $camp_network->getApplicantFemaleCount(),
                    "approve" => $camp_network->getApplicantApprovedCount(),
                ],
                "iot" => [
                    "total" => $camp_iot->getApplicantCount(),
                    "boy" => $camp_iot->getApplicantMaleCount(),
                    "girl" => $camp_iot->getApplicantFemaleCount(),
                    "approve" => $camp_iot->getApplicantApprovedCount(),
                ],
                "datasci" => [
                    "total" => $camp_datasci->getApplicantCount(),
                    "boy" => $camp_datasci->getApplicantMaleCount(),
                    "girl" => $camp_datasci->getApplicantFemaleCount(),
                    "approve" => $camp_datasci->getApplicantApprovedCount(),
                ],
                "checked" => $checked_count,
                "approve" => $approved_count,
                "boy" => $male_count,
                "girl" => $female_count,
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
