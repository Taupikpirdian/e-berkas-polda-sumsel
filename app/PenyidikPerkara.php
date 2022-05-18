<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenyidikPerkara extends Model
{
    protected $fillable = [
        'penyidik_id',
        'perkara_id',
        'no_urut',
    ];

    public function masterPenyidik()
	{
		return $this->belongsTo('App\Penyidik', 'penyidik_id', 'id');
	}
}
