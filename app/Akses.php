<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akses extends Model
{
    protected $fillable = [
		'user_id' , 'kategori_bagian_id'
    ];

    public function satker()
    {
    	return $this->belongsTo('App\KategoriBagian', 'kategori_bagian_id', 'id');
    }

    public function user()
    {
      return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function kategoriBagian()
    {
      return $this->belongsTo('App\KategoriBagian', 'kategori_bagian_id', 'id');
    }
}
