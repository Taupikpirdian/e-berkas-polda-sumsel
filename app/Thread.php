<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Thread extends Model
{
    protected $fillable = [
        'room'
    ];

    public function conversation()
	{
		return $this->belongsTo('App\Conversation', 'id', 'thread_id');
	}

    public function conversationNotRead()
	{
        return $this->hasMany(Conversation::class, 'thread_id', 'id')->where('is_read', 0)->where('user_id', '!=', Auth::user()->id);
	}

    public function participant() {
		return $this->belongsTo('App\Participant', 'id', 'thread_id');
    }

    public function listConversation() {
        return $this->hasMany(Conversation::class, 'thread_id', 'id');
    }
}
