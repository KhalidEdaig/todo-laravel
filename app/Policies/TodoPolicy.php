<?php

namespace App\Policies;

use App\Models\Todo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function delete(User $user,Todo $todo){
        return $user->id===$todo->createdBy_id;
    }
    public function edit(User $user,Todo $todo){
        return $user->id===$todo->createdBy_id;
    }
}
