<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'thread_id', 'user_id', 'message', 'type_message', 'is_read', 'original_name'
    ];
}
