<?php

namespace App\Http\Controllers\Backend;

use App\Applicant;
use App\Camp;
use App\Services\ValidatorService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AccountApplicantController extends Controller
{

    /**
     * Validator Service instance
     */
    private $validator;

    public function __construct(ValidatorService $validatorService)
    {
        $this->validator = $validatorService;
    }

    public function generateNewAccount($id) {
        if(!($applicant = Applicant::find($id))) {
            return redirect()->route('view.backend.applicant.select')->with('status', 'backend_applicant_user_not_found');
        }

        // Get last camp user count
        $camp_name = strtolower(__('camp.'.$applicant->camp->name));
        $last_username = User::where([
            ['type', '=', 'APPLICANT'],
            ['username', 'LIKE', $camp_name.'%']
        ])->orderBy('username', 'DESC')->first()->username;
        $last_count = substr($last_username, -3, 3);

        $new_username = sprintf('%s%03d', $camp_name, $last_count + 1);
        $new_password = implode("", explode("-", $applicant->getDetailValue('citizen_numid')));

        $applicant->user()->associate(User::create([
            "username" => $new_username, "password" => Hash::make($new_password), "type" => "APPLICANT", "active" => true
        ]));
        $applicant->state = "RESERVE";

        $applicant->save();

        return redirect()->route('view.backend.account.applicant.update', ['id' => $applicant->id])->with('status', 'backend_applicant_user_created');
    }

    public function showUpdateApplicant($id) {
        if(!($applicant = Applicant::find($id)) || $applicant->user == null) {
            return redirect()->route('view.backend.account.applicant')->with('status', 'backend_applicant_user_not_found');
        }

        $data = [
            "applicant" => $applicant,
            'evidence_state' => $applicant->evidences->count() > 0 ? $applicant->evidences->first()->state : 'NOT_SEND'
        ];

        if($applicant->evidences->count() > 0) {
            $data['evidence'] = $applicant->evidences->first();
        }

        return view('backend.group.account.applicant.update')->with($data);
    }

    public function activeAccount($id) {
        // Policies Check
        if (Gate::denies('update_applicant_account', User::class)) {
            return redirect()->route('view.backend.index')->with('status', 'backend_not_enough_permission_to_manage_applicant');
        }

        if(!($applicant = Applicant::find($id)) || $applicant->user == null) {
            return redirect()->route('view.backend.account.applicant')->with('status', 'backend_applicant_user_not_found');
        }

        $applicant->user->active = true;
        $applicant->user->save();

        return redirect()->back()->with('status', 'backend_active_applicant_account_complete');
    }

    public function deactiveAccount($id) {
        // Policies Check
        if (Gate::denies('update_applicant_account', User::class)) {
            return redirect()->route('view.backend.index')->with('status', 'backend_not_enough_permission_to_manage_applicant');
        }

        if(!($applicant = Applicant::find($id)) || $applicant->user == null) {
            return redirect()->route('view.backend.account.applicant')->with('status', 'backend_applicant_user_not_found');
        }

        $applicant->user->active = false;
        $applicant->user->save();

        return redirect()->back()->with('status', 'backend_deactive_applicant_account_complete');
    }

    public function updateApplicant(Request $request, $id) {
        // Policies Check
        if (Gate::denies('update_applicant_account', User::class)) {
            return redirect()->route('view.backend.index')->with('status', 'backend_not_enough_permission_to_manage_applicant');
        }

        abort(405);
    }

    /**
     * Update staff account's password
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function updateApplicantPassword(Request $request, $id) {
        // Policies Check
        if (Gate::denies('update_applicant_account', User::class)) {
            return redirect()->route('view.backend.index')->with('status', 'backend_not_enough_permission_to_manage_applicant');
        }

        $rules = [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ];
        $this->validator->validate($request, $rules);

        if($this->validator->containError('validation.required')) {
            return redirect()->back()->with('status', 'form_empty_field');
        } else if($this->validator->containError('validation.confirmed')) {
            return redirect()->back()->with('status', 'confirm_password_not_match');
        }

        $applicant = Applicant::find($id);
        $applicant->user->password = Hash::make($request->input('password'));
        $applicant->user->save();

        return redirect()->back()->with('status', 'backend_update_account_password_complete');
    }

    public function showApplicant() {
        $applicants = Applicant::whereNotNull('user_id')->get();

        $camps = Camp::all();
        $campIds = $camps->pluck('id')->all();

        $count = [];

        foreach($campIds as $campId) {
            $count[$camps->find($campId)->name] = [0, 0, 0, 0, 0, 0];

            foreach ($applicants as $applicant) {
                if($applicant->camp_id == $campId) {
                    $flag = true;

                    if(in_array($applicant->state, ['SELECT', 'CONFIRM_SELECT', 'CANCEL_SELECT'])) {
                        $count[$camps->find($campId)->name][0]++;
                    } else if(in_array($applicant->state, ['RESERVE', 'CONFIRM_RESERVE', 'CANCEL_RESERVE'])) {
                        $count[$camps->find($campId)->name][1]++;
                    }

                    if(in_array($applicant->state, ['CANCEL_SELECT', 'CANCEL_RESERVE'])) {
                        $count[$camps->find($campId)->name][4]++;
                        $flag = false;
                    }

                    if($flag) {
                        if($applicant->evidences->count() > 0) {
                            if($applicant->evidences->first()->state == "PENDING") {
                                $count[$camps->find($campId)->name][2]++;
                            } else if($applicant->evidences->first()->state == "COMPLETE") {
                                $count[$camps->find($campId)->name][3]++;
                            }
                        } else {
                            $count[$camps->find($campId)->name][5]++;
                        }
                    }
                }
            }
        }

        $data = [
            'applicants' => $applicants,
            'count' => $count,
            'camps' => $camps
        ];

        return view('backend.group.account.applicant.index')->with($data);
    }

}
