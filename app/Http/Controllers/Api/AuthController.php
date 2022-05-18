<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTraits;
use App\Http\Traits\ApiTraits;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponseTraits;
    use ApiTraits;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials)->get()->first();

        if (!$user) {
            return $this->badRequest('Email Anda salah');
        } else if (!\Hash::check($request->password, $user->password)) {
            // Bad Request response
            return $this->badRequest('Kata sandi anda salah');
        }

        if ($token = $user->createToken('auth_token')->plainTextToken) {
            return $this->ok("login", array('token' => $token, 'user' => $user));
        }

        return $this->unauthorized();
    }

    public function logout(Request $request)
    {
        $isLogout = $request->user()->currentAccessToken()->delete();

        if ($isLogout) {
            return $this->ok("logout");
        } else {
            return $this->badRequest('Logout gagal');
        }

    }

    public function validToken(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();
        
        if ($user) {
            return $this->ok("login kembali", array('token' => $token, 'user' => $user));
        } else {
            return $this->unauthorized();
        }
    }
}
