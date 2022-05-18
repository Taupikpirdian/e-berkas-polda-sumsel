<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriBagian extends Model
{
	protected $fillable = [
		'kategori_id',
		'wilayah_id',
		'tipe_lembaga_id',
		'name',
		'email',
		'alamat',
		'no_tlp'
	];

	public function kategori()
	{
		return $this->belongsTo('App\Kategori', 'kategori_id', 'id');
	}

	public function tipeLembaga()
	{
		return $this->belongsTo('App\MTipeLembaga', 'tipe_lembaga_id', 'id');
	}

	public function akses()
	{
		return $this->hasMany('App\Akses', 'kategori_bagian_id', 'id');
	}
}
