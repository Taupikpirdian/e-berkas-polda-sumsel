<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetPinController extends Controller
{
    protected function create(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->is_first_login = 1;
        $user->pin = Hash::make($request->pin);
        $user->save();

        return redirect()->route('dashboard');
    }
}
