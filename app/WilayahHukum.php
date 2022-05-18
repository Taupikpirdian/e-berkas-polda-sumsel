<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WilayahHukum extends Model
{
    protected $fillable = [
        'role', 'kode_induk', 'kode_relasi'
    ];

    public function kategoriBagianRelasi()
    {
        return $this->belongsTo('App\KategoriBagian', 'kode_relasi', 'kode');
    }

    public function kategoriBagianInduk()
    {
        return $this->belongsTo('App\KategoriBagian', 'kode_induk', 'kode');
    }
}
