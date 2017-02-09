<?php

namespace App\Policies;

use App\Question;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
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

    // TODO comment method (what is it?)

    public function before($user, $ability) {
        if($user->staff && $user->staff->is_admin) {
            return true;
        }
    }

    public function create(User $user) {
        if($user->staff) {
            if(
                ($user->staff->section->has_question && $user->staff->position == 'HEAD') || // Current auth user is HEAD and has question in section
                ($user->staff->section->name == 'knowledge') // Bypass camp for knowledge
            ) {
                return true;
            }
        }

        return false;
    }

    public function update(User $user, Question $question) {
        if($user->staff) {
            if(
                ($user->staff->section->name == $question->section->name && $user->staff->position == 'HEAD') || // Same section and current auth is HEAD
                ($user->staff->section->name == 'knowledge' && preg_match("/^camp_/", $question->section->name)) // Bypass camp for knowledge
            ) {
                return true;
            }
        }

        return false;
    }

    public function manage(User $user) {
        if($user->staff) {
            if(
                ($user->staff->section->has_question && $user->staff->position == 'HEAD') || // Current auth user is HEAD and has question in section
                ($user->staff->section->name == 'knowledge') // Bypass camp for knowledge
            ) {
                return true;
            }
        }

        return false;
    }
}
