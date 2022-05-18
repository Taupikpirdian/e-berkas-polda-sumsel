<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileDiversi extends Model
{
    protected $fillable = [
        'diversi_id',
        'code',
        'original_name',
        'name',
        'type_file',
        'path',
        'created_by',
        'updated_by',
    ];
}
