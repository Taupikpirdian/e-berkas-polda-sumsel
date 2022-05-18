<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TersangkaTitipanTahanan extends Model
{
    protected $fillable = [
        'name', 
        'titipantahanan_id', 
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
