<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignPerkaraToOperator extends Model
{
    protected $fillable = [
        'user_id',
        'perkara_id'
    ];
}
