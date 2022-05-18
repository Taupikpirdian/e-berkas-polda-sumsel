<?php

use App\Constant;
use App\MWilayah;
use App\KategoriBagian;
use Illuminate\Database\Seeder;

class KategoriBagianPolsekResorPaliTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 0;
        echo "Seeder kategori bagian tambahan dimulai ... ";
        echo "\n";

        $sppt_satker = array(
            array('kode' => '060.01.07.17.01', 'nama' => 'Kepolisian Sektor Talang Ubi'),
            array('kode' => '060.01.07.17.02', 'nama' => 'Kepolisian Sektor Panukal Abab'),
            array('kode' => '060.01.07.17.03', 'nama' => 'Kepolisian Sektor Panukal Utara'),
        );

        foreach ($sppt_satker as $data) {
            $kategori = '';
            echo "Proses data " . $data['nama'];
            echo "\n";
            $idWilayah = null;
            $idTipeLembaga = null;
            $digitCode = strlen($data['kode']);

            $kategori = Constant::N_KEPOLISIAN;

            if ($digitCode >= 9) { // get code wilayah polda, polres, polsek
                $wilayahCode = substr($data['kode'], 0, 9);
                $wilayah = MWilayah::where('kode', $wilayahCode)->first();
                $idWilayah = $wilayah ? $wilayah->id : null;

                if ($digitCode == 15) { // is polsek
                    $idTipeLembaga = Constant::POLSEK;
                }
            }

            if ($idWilayah == 37) { // id wilayah sumsel
                KategoriBagian::updateOrCreate(
                    [
                        'kode' => $data['kode'],
                        'wilayah_id' => $idWilayah,
                    ],
                    [
                        'kategori_id' => $kategori,
                        'tipe_lembaga_id' => $idTipeLembaga,
                        'name' => $data['nama']
                    ]
                );

                echo "Saved data " . $data['nama'];
                echo "\n";

                ++$count;
            }
        }

        echo "Proses seeder $count data selesai. Terimakasih DevOps...";
        echo "\n";
    }
}
