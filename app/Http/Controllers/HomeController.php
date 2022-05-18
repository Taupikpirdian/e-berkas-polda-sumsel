<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setPin()
    {
        // jika dalam keadaan login, redirect ke home
        $auth = Auth::user();
        if ($auth) {
            $is_first_login = $auth->is_first_login;
            // check sudah set pin atau belum
            if ($is_first_login == 1) {
                return redirect()->route('dashboard');
            }
            return view('auth.setpin');
        }
    }

    public function dashboard()
    {
        $auth = Auth::user();
        if ($auth) {
            $is_first_login = $auth->is_first_login;
            // check sudah set pin atau belum
            if ($is_first_login == 0) {
                return redirect()->route('set-pin');
            }
            return view('dashboard.index');
        } else {
            return view('dashboard.index');
        }
    }
}
