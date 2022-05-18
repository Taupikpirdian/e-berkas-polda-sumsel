<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tahanan extends Model
{
    protected $fillable = [
        'no_reg_instansi',
        'name',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'tanggal_ekspirasi',
        'tanggal_bebas',
        'keterangan'
    ];
}
