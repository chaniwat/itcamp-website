<?php

namespace App\Http\Controllers\Backend;

use App\Section;
use App\Staff;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AccountStaffController extends Controller
{

    /**
     * Create new staff account
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function createStaff(Request $request) {

        // TODO Check by Validator (Request)

        if(!$request->has(['username', 'password', 'cpassword', 'name'])) {
            return redirect()->back()->with('status', 'form_empty_field')->withInput($request->all());
        } else if($request->input('password') != $request->input('cpassword')) {
            return redirect()->back()->with('status', 'confirm_password_not_match')->withInput($request->all());
        } else if(User::where('username', $request->input('username'))->first() != null) {
            return redirect()->back()->with('status', 'username_already_used')->withInput($request->all());
        }

        // Create new User and Staff into DB
        $staff = new Staff();
        $staff->user()->associate(User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'type' => 'STAFF'
        ]));

        // Update staff account
        $this->structStaff($request, $staff);
        $staff->save();

        return redirect()->route('view.backend.account.staff')->with('status', 'backend_add_account_success');
    }

    /**
     * Update staff account
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function updateStaff(Request $request, $id) {

        // TODO Check by Validator (Request)

        if(!$request->has(['name'])) {
            return redirect()->back()->with('status', 'form_empty_field')->withInput($request->all());
        }

        // Find old staff account
        $staff = Staff::find($id);

        // Update staff account
        $this->structStaff($request, $staff);
        $staff->save();

        return redirect()->back()->with('status', 'backend_update_account_complete');
    }

    /**
     * Struct the staff account from input
     * @param Request $request
     * @param Staff $staff
     */
    protected function structStaff(Request $request, Staff $staff)
    {
        $staff->section()->associate(Section::find($request->input('section')));
        $staff->name = $request->input('name');
        $staff->is_head = !!$request->input('head');
        $staff->is_admin = !!$request->input('admin');
    }

    /**
     * Update staff account's password
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function updateStaffPassword(Request $request, $id) {

        // TODO Check by Validator (Request)

        if(!$request->has(['password', 'cpassword'])) {
            return redirect()->back()->with('status', 'form_empty_field');
        } else if($request->input('password') != $request->input('cpassword')) {
            return redirect()->back()->with('status', 'confirm_password_not_match');
        }

        $staff = Staff::find($id);
        $staff->user->password = Hash::make($request->input('password'));
        $staff->user->save();

        return redirect()->back()->with('status', 'backend_update_account_password_complete');
    }

    /**
     * Show view all staff
     * @return $this
     */
    public function showStaff() {
        return view('backend.group.account.staff.index')->with('users', User::where('type', 'STAFF')->get());
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
