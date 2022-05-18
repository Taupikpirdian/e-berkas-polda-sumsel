<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriBagianTurunan extends Model
{
    protected $fillable = [
        'kode_induk',
        'kode_turunan',
        'tipe_turunan',
    ];

    public function turunanKategoriBagian()
    {
        return $this->belongsTo('App\KategoriBagian', 'kode_turunan', 'kode');
    }
}
