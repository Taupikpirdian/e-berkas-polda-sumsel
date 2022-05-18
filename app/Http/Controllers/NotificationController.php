<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Notification;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\AuthRepository;
use App\Http\Repositories\All\GlobalRepository;

class NotificationController extends Controller
{
    public function countNotif()
    {
        $user_id = Auth::user()->id;
        $data = Notification::where('is_read', 0)->where('notif_for', $user_id)->count();
        return json_encode($data);
    }

    public function listNotif()
    {
        $user_id = Auth::user()->id;
        $datas = $this->getDataNotif($user_id, null, 5);

        // loop
        foreach ($datas as $dn) {
            $dataTime = Carbon::parse($dn->created_at);
            $nowTime = Carbon::now()->toDateTimeString();
            // for time
            $hours = $dataTime->diff($nowTime)->format('%H');
            $minutes = $dataTime->diff($nowTime)->format('%I');
            // for day
            $age_of_data = \Carbon\Carbon::parse($dn->created_at)->diff(\Carbon\Carbon::now())->format('%d');
            if ($age_of_data == 0) {
                // include data to collection
                if ($hours == 0) {
                    $dn->age_of_data = $minutes . " minutes ago";
                } else {
                    $dn->age_of_data = $hours . " hours ago";
                }
            } else {
                // include data to collection
                $dn->age_of_data = $age_of_data . " days ago";
            }

            // for message data
            $dn->message = $dn->desc;
        }

        return json_encode($datas);
    }

    public function listNotifForToastr()
    {
        $toast = true;
        $user_id = Auth::user()->id;
        $datas = $this->getDataNotif($user_id, $toast);
        // loop
        foreach ($datas as $dn) {
            // update data to not showing
            $data = Notification::find($dn->id);
            $data->is_show = Constant::IS_NOT_SHOW;
            $data->save();
            // for message data
            $dn->message = $dn->desc;
        }

        return json_encode($datas);
    }

    public function getDataNotif($user_id, $toast = null, $limit = null)
    {
        return (new GlobalRepository)->dataNotification($user_id, $toast, $limit);
    }

    public function listDataView()
    {
        // use livewire
        return view('notification.index');
    }

    public function callHelperEncryp($id)
    {
        $data = helperEncrypt($id);
        return json_encode($data);
    }

    public function validatePin($id, $pin, $notifType) {
        $user_id = Auth::user()->id;
        $authPin = (new AuthRepository)->checkPin($user_id, $pin);
        // if false, show sweat alert
        if ($authPin == true) {
            $param = [
                'auth_pin' => true,
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'PIN yang anda masukan benar!',
                // url_redirect perlu update berdasarkan notif_type di table notification 
                'url_redirect' => $notifType == Constant::NOTIF_PRANUT ? "/data-prapenuntutan/" . $id . "?mode=notif" : null,
            ];
            return json_encode($param);
        } else {
            $param = [
                'auth_pin' => false,
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'PIN yang anda masukan salah!',
                'url_redirect' => 'null',
            ];
            return json_encode($param);
        }
    }
}
