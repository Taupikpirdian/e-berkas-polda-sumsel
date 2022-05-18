<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileBpacTipiring extends Model
{
    protected $fillable = [
        'bpac_tipiring_id',
        'code',
        'original_name',
        'name',
        'type_file',
        'path',
        'created_by',
        'updated_by',
    ];
}
