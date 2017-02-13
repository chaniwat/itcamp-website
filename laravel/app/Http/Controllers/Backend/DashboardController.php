<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        return $this->showRegisterDashboard();
    }

    public function showRegisterDashboard() {
        /*
         * TODO Register dashboard
         * count applicant's (each camp), count check registration
         * count scoring answer (own check) -> do after finish scoring answer system
         */

        $data = [

        ];

        return view('backend.group.dashboard.register')->with('data', $data);
    }

    public function showOverviewDashboard() {
        /*
         * TODO Overview dashboard
         * count selected & reserve applicant's (each camp), count shirt size
         * count confirm applicant
         */

        abort(404);
    }
}
