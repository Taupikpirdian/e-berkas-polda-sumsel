<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PihakIzinPengadilan extends Model
{
    protected $fillable = [
        'izin_pengadilan_id',
        'jns_pihak',
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
    ];
}
