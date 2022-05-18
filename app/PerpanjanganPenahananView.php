<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerpanjanganPenahananView extends Model
{
    public $table = "perpanjanganpenahanan_v";

    public function perpanjanganPenahanan()
    {
		return $this->belongsTo('App\PerpanjanganPenahanan', 'datapenahanan_id', 'datapenahanan_id');
    }
}
