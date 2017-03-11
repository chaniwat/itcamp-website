<?php

namespace App\Services;

use App\Section;
use App\Staff;
use App\User;
use Illuminate\Support\Facades\Hash;

class AccountService
{

    /**
     * Create a new account for staff
     * @param $username
     * @param $password
     * @param $name
     * @param $section_id
     * @param $is_head
     * @param $is_admin
     * @return Staff Created staff
     */
    public function createStaff($username, $password, $name, $section_id, $is_head = false, $is_admin = false)
    {
        $staff = new Staff();
        $staff->user()->associate(User::create([
            'username' => $username,
            'password' => Hash::make($password),
            'type' => 'STAFF'
        ]));
        $this->structStaff($staff, $name, $section_id, $is_head, $is_admin);
        $staff->save();

        return $staff;
    }

    /**
     * Update staff
     * @param $id
     * @param $name
     * @param $section_id
     * @param bool $is_head
     * @param bool $is_admin
     * @return Staff Updated staff
     */
    public function updateStaff($id, $name, $section_id, $is_head = false, $is_admin = false)
    {
        $staff = Staff::find($id);
        $this->structStaff($staff, $name, $section_id, $is_head, $is_admin);
        $staff->save();

        return $staff;
    }

    /**
     * Update staff password
     * @param $id
     * @param $password
     * @return Staff Updated staff
     */
    public function updateStaffPassword($id, $password)
    {
        $staff = Staff::find($id);
        $staff->user->password = Hash::make($password);
        $staff->user->save();

        return $staff;
    }

    /**
     * Struct a staff
     * @param $staff
     * @param $name
     * @param $section_id
     * @param bool $is_head
     * @param bool $is_admin
     */
    private function structStaff($staff, $name, $section_id, $is_head = false, $is_admin = false)
    {
        $staff->section()->associate(Section::find($section_id));
        $staff->name = $name;
        $staff->is_head = !!$is_head;
        $staff->is_admin = !!$is_admin;
    }

}