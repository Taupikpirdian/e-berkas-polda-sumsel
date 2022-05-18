<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LimpahPerkara extends Model
{
	protected $fillable = [
		'perkara_id','pengadilan_id','created_by','updated_by'
	];
    
    public function perkara()
	{
		return $this->belongsTo('App\Perkara', 'perkara_id', 'id');
	}

    public function pengadilan()
	{
        return $this->belongsTo('App\User', 'pengadilan_id' ,'id');
	}
}
