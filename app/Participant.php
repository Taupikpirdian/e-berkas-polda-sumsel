<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'thread_id', 'user_id',
    ];

    public function thread()
	{
        return $this->hasMany(Thread::class, 'id','thread_id');
	}
}
