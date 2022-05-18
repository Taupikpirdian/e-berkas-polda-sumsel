<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TersangkaDiversi extends Model
{
    protected $fillable = [
        'diversi_id',
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
