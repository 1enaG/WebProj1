<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\UserRight;

class UserPolicy
{
    use HandlesAuthorization;

    const MODEL_NAME = 'user'; 

    public function __construct()
    {
        //
    }

    private function checkRight(User $user, String $right){
        return UserRight::where('user_id', $user->id)
            ->where('right', $right)
            ->where('model', self::MODEL_NAME)
            ->exists(); 
    }

    public function update(User $user){
        return $this->checkRight($user, 'update'); 
    }
    public function view(User $user){
        return $this->checkRight($user, 'view'); 
    }
}
