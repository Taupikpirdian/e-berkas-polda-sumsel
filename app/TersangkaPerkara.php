<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TersangkaPerkara extends Model
{
    protected $fillable = [
        'perkara_id', 
        'nik', 
        'name', 
        'tempat_lahir', 
        'tgl_lahir', 
        'jk', 
        'kebangsaan', 
        'alamat', 
        'agama', 
        'pekerjaan', 
        'pendidikan', 
        'pasal'
    ];

    public function perkara()
    {
        return $this->belongsTo('App\Perkara', 'perkara_id', 'id');
    }

    public function perpanjanganPenahanan()
    {
        return $this->hasOne('App\PerpanjanganPenahanan', 'perkara_id', 'id');
    }
}
