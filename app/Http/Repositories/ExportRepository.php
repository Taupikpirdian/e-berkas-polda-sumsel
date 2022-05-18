<?php

namespace App\Http\Repositories;

use App\BeritaAcara;
use PDF;

class ExportRepository
{
    public function beritaAcaraPDF($berita_acara_id)
    {
        $data_berita_acara = BeritaAcara::with('formil', 'materil', 'perkara')
            ->find($berita_acara_id);

        $data = [
            'from' => 'Kejaksaan Tinggi Sumatera Selatan',
            'subject' => 'Untuk Keadilan',
            'berita_acara' => $data_berita_acara,
        ];

        $pdf = PDF::loadView('export-pdf.berita-acara', $data)
            ->setPaper('A4','portrait')
            ->output();

        $now = date('d-M-Y H:i:s');

        return response()->streamDownload(fn() => print($pdf), 'Berita Acara '.$now.'.pdf');
    }
}
