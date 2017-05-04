<?php

namespace App\Services;

use App\Section;
use App\Staff;
use App\User;
use Illuminate\Support\Facades\Hash;

class AccountService
{

    /**
     * Update staff password
     * @param $staff
     * @param $password
     * @return Staff Updated staff
     * @internal param $id
     */
    public function updateStaffPassword($staff, $password)
    {
        if(is_numeric($staff)) {
            $staff = Staff::find($staff);
        }

        $staff->user->password = Hash::make($password);
        $staff->user->save();

        return $staff;
    }

    /**
     * Fill value into staff
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