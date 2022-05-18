<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TersangkaPenahanan extends Model
{
    protected $fillable = [
        'datapenahanan_id',
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
}
