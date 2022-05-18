<?php

namespace App\Http\Traits;

use Laravel\Sanctum\Sanctum;
use App\User;

trait ApiTraits
{
    protected function hasTokenApi($request)
    {
        $token = $request->bearerToken();
        if ($token) {
            return true;
        } else {
            return false;
        }
    }

    protected function userIdFromTokenApi($request)
    {
        $token = $request->bearerToken();
        if ($token) {
            $model = Sanctum::$personalAccessTokenModel;
            $findToken = $model::findToken($token);
            if ($findToken != null) {
                return $findToken->tokenable_id;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    protected function userFromTokenApi($request)
    {
        $token = $request->bearerToken();
        if ($token) {
            $model = Sanctum::$personalAccessTokenModel;
            $findToken = $model::findToken($token);
            if ($findToken != null) {
                return User::find($findToken->tokenable_id);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
