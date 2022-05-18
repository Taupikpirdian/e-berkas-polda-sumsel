<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTraits;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    use ApiResponseTraits;

    public function v1(Request $request)
    {
        $request->validate([
            'app_version' => 'required|string',
            'api_version' => 'required|string',
        ]);

        $app_version = "1.0.1";
        $api_version = "1.0";
        $status = false;

        if ($request->app_version === $app_version && $request->api_version === $api_version) {
            $status = true;
        }

        if ($status) {
            $message = ", versi aplikasi dan versi api sesuai !";
            $data = array('url' => 'https://www.google.com');
            return $this->ok($message, $data);
        } else {
            return $this->upgradeRequired();
        }
    }
}
