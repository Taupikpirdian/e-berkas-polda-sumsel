<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyidik extends Model
{
	protected $fillable = [
		'user_id', 'nrp', 'name', 'pangkat_id', 'subdit_id'
	];

	public function pangkat()
	{
		return $this->belongsTo('App\Pangkat', 'pangkat_id', 'id');
	}

	public function subDit()
	{
		return $this->belongsTo('App\MSubdit', 'subdit_id', 'id');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id', 'id');
	}
}
