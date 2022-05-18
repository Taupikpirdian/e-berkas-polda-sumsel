<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'instansi_id', 'email', 'password', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function akses()
    {
        return $this->hasMany('App\Akses', 'user_id');
    }

    public function instansi()
    {
        return $this->belongsTo('App\Instansi', 'instansi_id', 'id');
    }

    public function jpu()
    {
        return $this->belongsTo('App\JaksaPenuntutUmum', 'id', 'user_id');
    }

    public function aksesFirst()
    {
        return $this->belongsTo('App\Akses', 'id', 'user_id');
    }

    public function penyidik()
    {
        return $this->belongsTo('App\Penyidik', 'id', 'user_id');
    }
}
