<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileTitipanPenahanan extends Model
{
    protected $fillable = [
        'titipanpenahanan_id',
        'code',
        'original_name',
        'name',
        'type_file',
        'path',
        'created_by',
        'updated_by',
    ];
}
