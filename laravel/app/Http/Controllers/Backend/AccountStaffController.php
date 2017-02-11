<?php

namespace App\Http\Controllers\Backend;

use App\Section;
use App\Services\AccountService;
use App\Services\ValidatorService;
use App\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountStaffController extends Controller
{

    /**
     * Account Service instance
     */
    private $account;

    /**
     * Validator Service instance
     */
    private $validator;

    public function __construct(AccountService $accountService, ValidatorService $validatorService)
    {
        $this->validator = $validatorService;
        $this->account = $accountService;
    }

    /**
     * Create new staff account
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function createStaff(Request $request) {

        $rules = [
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'name' => 'required'
        ];
        $this->validator->validate($request, $rules);

        if($this->validator->containError('validation.required')) {
            return redirect()->back()->with('status', 'form_empty_field')->withInput($request->all());
        } else if($this->validator->containError('validation.confirmed')) {
            return redirect()->back()->with('status', 'confirm_password_not_match')->withInput($request->all());
        } else if($this->validator->containError('validation.unique')) {
            return redirect()->back()->with('status', 'username_already_used')->withInput($request->all());
        }

        $this->account->createStaff(
            $request->input('username'),
            $request->input('password'),
            $request->input('name'),
            $request->input('section'),
            $request->input('head'),
            $request->input('admin')
        );

        return redirect()->route('view.backend.account.staff')->with('status', 'backend_add_account_success');
    }

    /**
     * Update staff account
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function updateStaff(Request $request, $id) {

        $rules = [
            'name' => 'required'
        ];
        $this->validator->validate($request, $rules);

        if($this->validator->containError('validation.required')) {
            return redirect()->back()->with('status', 'form_empty_field')->withInput($request->all());
        }

        $this->account->updateStaff(
            $id,
            $request->input('name'),
            $request->input('section'),
            $request->input('head'),
            $request->input('admin')
        );

        return redirect()->back()->with('status', 'backend_update_account_complete');
    }

    /**
     * Update staff account's password
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function updateStaffPassword(Request $request, $id) {

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

        $this->account->updateStaffPassword($id, $request->input('password'));

        return redirect()->back()->with('status', 'backend_update_account_password_complete');
    }

    /**
     * Show view all staff
     * @return $this
     */
    public function showStaff() {
        return view('backend.group.account.staff.index')->with('staffs', Staff::all());
    }

    /**
     * Show view create staff
     * @return $this
     */
    public function showCreateStaff() {
        $data = [
            'sections' => Section::all()
        ];

        return view('backend.group.account.staff.create')->with('data', $data);
    }

    /**
     * Show view edit staff (update staff)
     * @param $id
     * @return $this
     */
    public function showUpdateStaff($id) {
        $data = [
            'sections' => Section::all(),
            'staff' => Staff::find($id)
        ];

        return view('backend.group.account.staff.update')->with('data', $data);
    }

}
