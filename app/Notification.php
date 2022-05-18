<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        // 'jaksa_penuntut_umum_id', 'perkara_id', 'catatan'
    ];
    
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'notif_for', 'id');
    }

    public function perkara()
    {
        return $this->belongsTo(Perkara::class, 'data_id', 'id');
    }
}
