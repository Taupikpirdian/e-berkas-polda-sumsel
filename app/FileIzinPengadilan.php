<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileIzinPengadilan extends Model
{
    protected $fillable = [
        'izin_pengadilan_id',
        'jns_file',
        'original_name',
        'name',
        'type_file',
        'path',
        'created_by',
        'created_at',
    ];
}
