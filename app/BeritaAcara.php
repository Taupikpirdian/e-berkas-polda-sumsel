<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    protected $fillable = [
        'perkara_id',
        'kesimpulan',
        'kategori_id',
        'kategori_bagian_id',
        'alamat',
        'surat_perintah',
        'tanggal'
    ];

    public function perkara()
    {
        return $this->belongsTo('App\Perkara', 'perkara_id', 'id');
    }

    public function formil()
    {
        return $this->hasMany(Formil::class, 'berita_acara_id', 'id');
    }

    public function materil()
    {
        return $this->hasMany(Materil::class, 'berita_acara_id', 'id');
    }
}
