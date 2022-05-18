<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JaksaPenuntutUmum extends Model
{
    protected $fillable = [
        'name', 'nip', 'no_tlp', 'status', 'pangkat_id', 'user_id',
    ];

    public function pangkat()
    {
        return $this->belongsTo('App\Pangkat', 'pangkat_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function akses()
    {
        return $this->belongsTo('App\Akses', 'user_id', 'user_id');
    }
}
