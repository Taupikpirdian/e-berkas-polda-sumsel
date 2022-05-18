<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangBuktiNarkotikaFile extends Model
{
    protected $fillable = [
        'barangbuktinarkotika_id',
        'code_id',
        'original_name',
        'name',
        'type_file',
        'path',
        'created_by',
        'updated_by',
    ];
}
