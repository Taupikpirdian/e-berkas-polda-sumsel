<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignPerkara extends Model
{
    protected $fillable = [
		'jaksa_penuntut_umum_id' , 'perkara_id','catatan'
    ];

    public function perkara()
	{
		return $this->belongsTo('App\Perkara', 'perkara_id', 'id');
	}

	public function akses()
	{
        return $this->belongsTo('App\Akses', 'jaksa_penuntut_umum_id', 'user_id');
	}

	public function masterJaksa()
	{
		return $this->belongsTo('App\JaksaPenuntutUmum', 'jaksa_penuntut_umum_id', 'id');
	}
}
