<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilePenahanan extends Model
{
    protected $fillable = [
        'data_penahanan_id',
        'code',
        'original_name',
        'name',
        'type_file',
        'path',
        'catatan',
        'created_by',
        'updated_by',
    ];
}
