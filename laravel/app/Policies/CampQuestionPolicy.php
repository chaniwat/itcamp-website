<?php

namespace App\Policies;

use App\Question;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampQuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Determined if logged user can pass to check policies (before check all policies)
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before(User $user, $ability) {
        if(
            // Current logged user is staff
            $user->isStaff()
        ) {
            return null;
        }

        return false;
    }

    /**
     * Can logged user create new question
     * @param User $user
     * @return bool
     */
    public function create(User $user) {
        $staff = $user->staff;

        if(
            // Bypass admin and web developer
            ($staff->is_admin || $staff->section->name == 'web_developer') ||
            // Bypass camp question for knowledge
            ($staff->section->name == 'knowledge') ||
            // Current logged staff is HEAD and has question in section
            ($staff->section->has_question && $staff->is_head)
        ) {
            return true;
        }

        return false;
    }

    /**
     * Can logged user make given question
     * @param User $user
     * @param Question $question
     * @return bool
     */
    public function make(User $user, Question $question) {
        $staff = $user->staff;

        if(
            // Bypass admin and web developer
            ($staff->is_admin || $staff->section->name == 'web_developer') ||
            // Bypass camp question for knowledge
            ($staff->section->name == 'knowledge' && preg_match("/^camp_/", $question->section->name)) ||
            // Current logged staff is HEAD and has question in section and in the same section of question
            ($staff->section->has_question && $staff->section->name == $question->section->name && $staff->is_head)
        ) {
            return true;
        }

        return false;
    }

    /**
     * Can question be updated by logged user
     * @param User $user
     * @param Question $question
     * @return bool
     */
    public function update(User $user, Question $question) {
        $staff = $user->staff;

        if(
            // Bypass admin and web developer
            ($staff->is_admin || $staff->section->name == 'web_developer') ||
            // Bypass camp question for knowledge
            ($staff->section->name == 'knowledge' && preg_match("/^camp_/", $question->section->name)) ||
            // Current logged staff is in the same section and current auth is HEAD
            ($staff->section->name == $question->section->name && $staff->is_head)
        ) {
            return true;
        }

        return false;
    }

    /**
     * Can logged user view question (ex. view)
     * @param User $user
     * @return bool
     */
    public function view(User $user) {
        $staff = $user->staff;

        if(
            // Bypass admin and web developer
            ($staff->is_admin || $staff->section->name == 'web_developer') ||
            // Bypass camp for knowledge
            ($staff->section->name == 'knowledge') ||
            // Current logged staff is HEAD and has question in section
            ($staff->section->has_question && $staff->is_head)
        ) {
            return true;
        }

        return false;
    }

}
