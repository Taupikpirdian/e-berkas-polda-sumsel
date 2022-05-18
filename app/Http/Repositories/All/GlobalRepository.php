<?php

namespace App\Http\Repositories\All;

use App\Notification;

class GlobalRepository
{
    public function readNotification($id)
    {
        $notification = Notification::find($request->id_notification);
        $notification->is_read = true;
        $notification->save();

        return $notification;
    }

    public function dataNotification($user_id, $toast = null, $limit = null, $pagination = false)
    {
        $datas = Notification::select([
            'notifications.id',
            'notifications.user_id',
            'notifications.notif_for',
            'notifications.desc',
            'notifications.is_read',
            'notifications.is_show',
            'notifications.data_id',
            'notifications.notif_type',
            'notifications.created_at',
        ])->when($toast, function ($q) {
            return $q->where('is_show', 1);
        })->when($toast == null, function ($q) {
            return $q->where('is_read', 0);
        })->when($toast, function ($q) {
            return $q->limit(5);
        })->when($toast == null, function ($q) {
            return $q->limit(6);
        })->where('notif_for', $user_id)
            ->orderBy('notifications.created_at', 'desc');

        if ($limit != null) {
            $datas = $datas->limit($limit);
        }

        $datas = $pagination ? $datas->paginate() : $datas->get();
        return $datas;
    }
}
