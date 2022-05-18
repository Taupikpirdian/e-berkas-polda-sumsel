<?php

namespace App\Http\Repositories;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    public function checkPin($user_id, $pinInput)
    {
        $check_data = User::where(['id' => $user_id])->first();
        // check PIN
        $resPin = checkPin($pinInput, $check_data->pin);
        if(!$resPin){
            return false;
        }else{
            return true;
        }
    }
}
