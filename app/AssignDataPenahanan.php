<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignDataPenahanan extends Model
{
    protected $fillable = [
		'datapenahanan_id' , 
        'akses_id',
        'name',
        'type',
    ];

    public function jaksa()
    {
		return $this->belongsTo('App\JaksaPenuntutUmum', 'akses_id', 'id');
    }
}
