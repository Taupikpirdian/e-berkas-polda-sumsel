<?php

namespace App\Services;

class BroadcastWhatsappServices {
    static function sendWa($to, $description) {
        /**
         * documentation
         * https://chat-api.com/en/docs.html
         */
        $data = [
            'phone' => $to, // Receivers phone '6282112824660'
            'body' => $description, // Message 'Tes API whatsapp!'
        ];
        $json = json_encode($data); // Encode data to JSON
        // URL for request POST /message
        $token = 'k7shoc86casaa7jv  ';
        $instanceId = '377353';
        $url = 'https://api.chat-api.com/instance'.$instanceId.'/message?token='.$token;
        // Make a POST request
        $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        // Send a request
        $result = file_get_contents($url, false, $options);
    }
}