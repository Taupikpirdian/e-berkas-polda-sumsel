<?php

use App\Constant;
use App\KategoriBagian;
use App\KategoriBagianTurunan;
use Illuminate\Database\Seeder;

class KategoriBagianTurunanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // satker kepolisian
        $kategoriKepolisians = KategoriBagian::where('kategori_id', Constant::N_KEPOLISIAN)
            ->where('tipe_lembaga_id', '!=', NULL)
            ->get();

        // clear all
        KategoriBagianTurunan::truncate();
        // polda -> polres
        foreach ($kategoriKepolisians->where('tipe_lembaga_id', Constant::POLDA) as $polda) {
            $kodeInduk = $polda->kode;
            foreach ($kategoriKepolisians->where('tipe_lembaga_id', Constant::POLRES) as $polres) {
                $checkKode = strstr($polres->kode, $kodeInduk);
                if ($checkKode) {
                    KategoriBagianTurunan::create([
                        'kode_induk' => $kodeInduk,
                        'kode_turunan' => $polres->kode,
                        'tipe_turunan' => Constant::TURUNAN_POLDA,
                    ]);

                    echo "Saved data " . $polres->kode;
                    echo "\n";
                }
            }
        }
        // polres -> polsek
        foreach ($kategoriKepolisians->where('tipe_lembaga_id', Constant::POLRES) as $polda) {
            $kodeInduk = $polda->kode;
            foreach ($kategoriKepolisians->where('tipe_lembaga_id', Constant::POLSEK) as $polres) {
                $checkKode = strstr($polres->kode, $kodeInduk);
                if ($checkKode) {
                    KategoriBagianTurunan::create([
                        'kode_induk' => $kodeInduk,
                        'kode_turunan' => $polres->kode,
                        'tipe_turunan' => Constant::TURUNAN_POLRES,
                    ]);

                    echo "Saved data " . $polres->kode;
                    echo "\n";
                }
            }
        }
    }
}
