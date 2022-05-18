<?php

use App\Constant;
use App\MWilayah;
use App\KategoriBagian;
use Illuminate\Database\Seeder;

class KategoriBagianTambahanTableSeeder extends Seeder
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
            array('kode' => '060.01.07.16', 'nama' => 'Kepolisian Resor Musi Rawas Utara'),
            array('kode' => '060.01.07.16.00.08', 'nama' => 'Kepolisian Resor Musi Rawas Utara Sat SPKT'),
            array('kode' => '060.01.07.16.00.10', 'nama' => 'Kepolisian Resor Musi Rawas Utara Sat Sat Reskrim'),
            array('kode' => '060.01.07.16.00.11', 'nama' => 'Kepolisian Resor Musi Rawas Utara Sat Sat Resnarkoba'),
            array('kode' => '060.01.07.16.00.14', 'nama' => 'Kepolisian Resor Musi Rawas Utara Sat Sat Lantas'),
            array('kode' => '060.01.07.17', 'nama' => 'Kepolisian Resor Penukal Abab Lematang Ilir'),
            array('kode' => '060.01.07.17.00.08', 'nama' => 'Kepolisian Resor Penukal Abab Lematang Ilir Sat SPKT'),
            array('kode' => '060.01.07.17.00.10', 'nama' => 'Kepolisian Resor Penukal Abab Lematang Ilir Sat Sat Reskrim'),
            array('kode' => '060.01.07.17.00.11', 'nama' => 'Kepolisian Resor Penukal Abab Lematang Ilir Sat Sat Resnarkoba'),
            array('kode' => '060.01.07.17.00.14', 'nama' => 'Kepolisian Resor Penukal Abab Lematang Ilir Sat Sat Lantas'),
        );

        foreach ($sppt_satker as $data) {
            $kategori = '';
            echo "Proses data " . $data['nama'];
            echo "\n";
            $idWilayah = null;
            $idTipeLembaga = null;
            $digitCode = strlen($data['kode']);

            $kategori = Constant::N_KEPOLISIAN;

            if ($digitCode == 9) { // save code wilayah
                MWilayah::create([
                    'kode' => $data['kode'],
                    'name' => $data['nama']
                ]);

                $idTipeLembaga = Constant::POLDA;
            }

            if ($digitCode >= 9) { // get code wilayah polda, polres, polsek
                $wilayahCode = substr($data['kode'], 0, 9);
                $wilayah = MWilayah::where('kode', $wilayahCode)->first();
                $idWilayah = $wilayah ? $wilayah->id : null;

                if ($digitCode == 12) { // is polres
                    $idTipeLembaga = Constant::POLRES;
                }

                if ($digitCode == 15) { // is polsek
                    $idTipeLembaga = Constant::POLSEK;
                }

                if ($digitCode == 18) { // is direktorat
                    $codeDitOrSat = substr($data['kode'], 0, 12);

                    $tipeLembaga = KategoriBagian::where('kode', $codeDitOrSat)->first();
                    if ($tipeLembaga != null) {
                        if ($tipeLembaga->tipe_lembaga_id == Constant::POLRES) {
                            $idTipeLembaga = Constant::SATUAN_POLRES;
                        }
                    } else {
                        $idTipeLembaga = Constant::DIREKTORAT_POLDA;
                    }
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
