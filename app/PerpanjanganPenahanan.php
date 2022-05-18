<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerpanjanganPenahanan extends Model
{
    protected $fillable = [
        'kategori_id', 'kategori_bagian_id', 'datapenahanan_id', 'perkara_id', 'nomor_t4', 'tanggal_t4', 'nomor_permintaan_perpanjangan', 'tanggal_permintaan_perpanjangan', 'uraian_kejadian', 'lama_perpanjangan', 'tanggal_perpanjangan_penahanan', 'rumah_tahanan', 'tanda_tangan'
    ];

    public function perkara()
    {
        return $this->belongsTo('App\Perkara', 'perkara_id', 'id');
    }

    public function rumahTahanan()
    {
        return $this->hasOne('App\RumahTahanan', 'id', 'rumah_tahanan');
    }

    public function tandaTangan()
    {
        return $this->hasOne('App\Pejabat', 'id', 'tanda_tangan');
    }

    public function filePerpanjanganPenahanan()
    {
        return $this->belongsTo('App\PerpanjanganPenahananFile', 'id', 'perpanjanganpenahanan_id');
    }
}
