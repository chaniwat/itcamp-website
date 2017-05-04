<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\BaseException;
use App\Exceptions\StaffNotFound;
use App\Section;
use App\Services\AccountService;
use App\Services\ValidatorService;
use App\Staff;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AccountStaffController extends Controller
{
    /**
     * Validator Service instance
     */
    private $validator;

    /**
     * Account Service instance
     */
    private $account;

    public function __construct(AccountService $accountService, ValidatorService $validatorService)
    {
        $this->validator = $validatorService;
        $this->account = $accountService;
    }

    public function updateSelfPassword(Request $request) {
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

        $this->account->updateStaffPassword(Auth::user()->staff, $request->input('password'));

        return redirect()->route('view.backend.index')->with('status', 'backend_update_account_password_complete');
    }

    public function showUpdateSelfPassword() {
        return view('backend.update_password');
    }

    /**
     * Create new staff account
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function createStaff(Request $request) {
        // Policies Check
        if (Gate::denies('create_staff_account', User::class)) {
            return redirect()->route('view.backend.index')->with('status', 'backend_not_enough_permission_to_manage_staff');
        }

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

        (new Staff())->fill($request->except('password_confirmation'))->save();

        return redirect()->route('view.backend.account.staff')->with('status', 'backend_add_account_success');
    }

    /**
     * Update staff account
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws StaffNotFound
     */
    public function updateStaff(Request $request, $id) {
        // Policies Check
        if(Gate::denies('update_staff_account', User::class)) {
            return redirect()->route('view.backend.index')->with('status', 'backend_not_enough_permission_to_manage_staff');
        }

        // Check if staff exists
        if(($staff = Staff::find($id)) == null) {
            throw new StaffNotFound($id);
        }

        // Validating inputs
        $rules = ['name' => 'required'];
        $this->validator->validate($request, $rules);
        if($this->validator->containError('validation.required')) {
            return redirect()->back()->with('status', 'form_empty_field')->withInput($request->all());
        }

        // Update staff
        $staff->fill($request->all())->save();

        return redirect()->back()->with('status', 'backend_update_account_complete');
    }

    /**
     * Update staff account's password
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function updateStaffPassword(Request $request, $id) {
        // Policies Check
        if (Gate::denies('update_staff_account', User::class)) {
            return redirect()->route('view.backend.index')->with('status', 'backend_not_enough_permission_to_manage_staff');
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

        $this->account->updateStaffPassword($id, $request->input('password'));

        return redirect()->back()->with('status', 'backend_update_account_password_complete');
    }

    /**
     * Show view all staff
     * @return $this
     */
    public function showStaff() {
        // Policies Check
        if (Gate::denies('view_staff_account', User::class)) {
            return redirect()->route('view.backend.index')->with('status', 'backend_not_enough_permission_to_manage_staff');
        }

        return view('backend.group.account.staff.index')->with('staffs', Staff::all());
    }

    /**
     * Show view create staff
     * @return $this
     */
    public function showCreateStaff() {
        // Policies Check
        if (Gate::denies('create_staff_account', User::class)) {
            return redirect()->route('view.backend.index')->with('status', 'backend_not_enough_permission_to_manage_staff');
        }

        $data = [
            'sections' => Section::all()
        ];

        return view('backend.group.account.staff.create')->with('data', $data);
    }

    /**
     * Show view edit staff (update staff)
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws StaffNotFound
     */
    public function showUpdateStaff($id) {
        // Policies Check
        if (Gate::denies('update_staff_account', User::class)) {
            return redirect()->route('view.backend.index')->with('status', 'backend_not_enough_permission_to_manage_staff');
        }

        // Check if staff exists
        if(($staff = Staff::find($id)) == null) {
            throw new StaffNotFound($id);
        }

        return view('backend.group.account.staff.update')->with([
            'sections' => Section::all(),
            'staff' => $staff
        ]);
    }

}
