<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;

class WelcomeController extends Controller
{
    public function index()
    {
        // jika dalam keadaan login, redirect ke home
        $auth = Auth::user();
        if ($auth) {
            $is_first_login = $auth->is_first_login;
            // check sudah set pin atau belum
            if ($is_first_login == 0) {
                return redirect()->route('set-pin');
            }
            return redirect()->route('dashboard');
        } else {
            return view('welcome');
        }
    }

    public function noHaveAkses()
    {
        return view('error.403-no-have-akses');
    }

    public function noHaveRole()
    {
        return view('error.403-no-have-role');
    }

    public function sendWa()
    {
        /**
         * documentation
         * https://chat-api.com/en/docs.html
         */
        $data = [
            'phone' => '6285846132417', // Receivers phone
            'body' => 'Tes API whatsapp!', // Message
        ];
        $json = json_encode($data); // Encode data to JSON
        // URL for request POST /message
        $token = 'v8qy722vn3vqz7sr';
        $instanceId = '375389';
        $url = 'https://api.chat-api.com/instance' . $instanceId . '/message?token=' . $token;
        // Make a POST request
        $options = stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        // Send a request
        $result = file_get_contents($url, false, $options);

        dd($result);
    }

    public function sendWaTwilio()
    {
        /**
         * documentation
         * https://chat-api.com/en/docs.html
         */

        $opikNumber = "+6285846132417";
        $mamahNumber = "+6289605971308";

        $sid    = "AC39bbb31c5e4581262e34b9d65a5fb1a0";
        $token  = "6a25eb5d395d5fa8ca11bad8420a1bca";
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                "whatsapp:" . $opikNumber, // to 
                array(
                    "from" => "whatsapp:+14155238886",
                    "body" => "Tes API Menggunakan Twilio"
                )
            );

        dd($message);
    }
}
