<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\All\GlobalRepository;
use App\Http\Traits\ApiResponseTraits;
use App\Http\Traits\ApiTraits;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    use ApiResponseTraits;
    use ApiTraits;

    public function getNotification(Request $request)
    {
        try {
            $data = (new GlobalRepository)->dataNotification(Auth::user(), null, 20, true);
            return $this->ok("mendapatkan data notifikasi", $data);
        } catch (\Exception $e) {
            return $this->badRequest("Error : " . $e);
        }
    }

    public function countNotif(Request $request)
    {
        $user_id = $this->userIdFromTokenApi($request);
        if (!$user_id) {
            return $this->unauthorized();
        }

        try {
            $validated = Validator::make($request->all(), [
                'is_read' => 'required|boolean',
            ]);
            if ($validated->fails()) {
                return $this->validationFail($validated->errors()->all());
            }

            $data = Notification::where('is_read', $request->is_read)
                ->where('notif_for', $user_id)->count();

            $result = array(
                "total" => $data,
            );
            $message = "mendapatkan jumlah data notifikasi";
            return $this->ok($message, $result);
        } catch (\Exception $e) {
            return $this->badRequest("Error : " . $e);
        }
    }

    public function readNotification(Request $request)
    {
        try {
            $validated = Validator::make($request->all(), [
                'id_notification' => 'required|exists:notifications,id',
            ]);
            if ($validated->fails()) {
                return $this->validationFail($validated->errors()->all());
            }

            $notification = (new GlobalRepository)->readNotification($request->id_notification);

            $message = "membaca notifikasi";
            return $this->ok($message, $notification);
        } catch (\Exception $e) {
            return $this->badRequest("Error : " . $e);
        }
    }
}
