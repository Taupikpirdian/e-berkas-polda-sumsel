<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IzinPengadilan extends Model
{
    protected $fillable = [
        'perkara_id',
        'user_id',
        'jns_penetapan_id',
        'penggeledahan_terhadap_id',
        'kategori_id',
        'kategori_bagian_id',
        'pengadilan_id',
        'tgl_surat_permohonan',
        'no_surat_permohonan',
        'tgl_surat_perintah',
        'no_surat_perintah',
        'tgl_lapor',
        'no_lapor',
        'tgl_ba',
        'no_ba',
        'lokasi',
        'jns_izin',
        'status',
        'barang_sita',
        'created_by',
        'updated_by',
    ];

    public function penggeledahanTerhadap()
    {
        return $this->belongsTo('App\PenggeledahanTerhadap', 'penggeledahan_terhadap_id', 'id');
    }

    public function jenisPenetapan()
    {
        return $this->belongsTo('App\JenisPenetapan', 'jns_penetapan_id', 'id');
    }

    public function pihak()
    {
        return $this->belongsTo('App\PihakIzinPengadilan', 'id', 'izin_pengadilan_id');
    }

    public function pengadilan()
    {
        return $this->belongsTo('App\KategoriBagian', 'pengadilan_id', 'id');
    }

    public function filePengajuan()
    {
        return $this->hasOne('App\FileIzinPengadilan', 'izin_pengadilan_id', 'id')->where('jns_file', Constant::PENGAJUAN_IZIN_PENGADILAN)->orderBy('created_at', 'desc');
    }

    public function fileBalasan()
    {
        return $this->hasOne('App\FileIzinPengadilan', 'izin_pengadilan_id', 'id')->where('jns_file', Constant::BALASAN_IZIN_PENGADILAN)->orderBy('created_at', 'desc');
    }

    public function fileIzin()
    {
        return $this->hasMany(FileIzinPengadilan::class, 'izin_pengadilan_id', 'id');
    }
}
