<?php

namespace App\Http\Livewire\Notification;

use App\Http\Repositories\AuthRepository;
use App\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Constant;

class ListNotificationPage extends Component
{
    protected $listeners = [
        'authPinNotification',
    ];

    public function render()
    {
        $user_id = thisUser()->id;

        $datas = Notification::with(['perkara'])
            ->where('notif_for', $user_id)
            ->orderBy('notifications.created_at', 'desc')
            ->get();

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
        }

        return view('livewire.notification.list-notification-page', compact('datas'));
    }

    public function authPinNotification($id, $pin, $notifType)
    {
        $user_id = Auth::user()->id;
        $authPin = (new AuthRepository)->checkPin($user_id, $pin);
        // if false, show sweat alert
        if ($authPin == true) {
            $param = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'PIN yang anda masukan benar!',
                // url_redirect perlu update berdasarkan notif_type di table notification 
                'url_redirect' => $notifType == Constant::NOTIF_PRANUT ? "/data-prapenuntutan/" . $id . "?mode=notif" : null,
            ];
            $this->emit('sweetAlertWithRedirect', $param);
        } else {
            $param = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'PIN yang anda masukan salah!',
                'url_redirect' => null,
            ];
            $this->emit('sweetAlert', $param);
        }
    }
}
