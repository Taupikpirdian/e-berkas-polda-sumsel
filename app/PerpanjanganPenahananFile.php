<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerpanjanganPenahananFile extends Model
{
    protected $fillable = [
        'perpanjanganpenahanan_id',
        'code_id',
        'original_name',
        'name',
        'type_file',
        'path',
        'created_by',
        'updated_by',
    ];
}
