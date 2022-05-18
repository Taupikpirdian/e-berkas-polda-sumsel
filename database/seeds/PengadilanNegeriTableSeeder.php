<?php

use App\PengadilanNegeri;
use Illuminate\Database\Seeder;

class PengadilanNegeriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // inisialisasi
        $data = array(
            array('Pengadilan Negeri Palembang','Kota Palembang'),
            array('Pengadilan Negeri Kayu Agung','Kabupaten Ogan Komering Ilir dan Kabupaten Ogan Ilir'),
            array('Pengadilan Negeri Sekayu', 'Kabupaten Kabupaten Musi Banyuasin'),
            array('Pengadilan Negeri Muara Enim','Kabupaten Muaraenim dan Kabupaten Penukal Abab Lematang Ilir'),
            array('Pengadilan Negeri Baturaja','Kabupaten Ogan Komering Ulu, Kabupaten OKU Selatan, dan Kabupaten OK Timur'),
            array('Pengadilan Negeri Lahat','Kabupaten Lahat dan Kabupaten Empat Lawang'),
            array('Pengadilan Negeri Lubuk Linggau','Kabupaten Lubuklinggau, Kabupaten Musi Rawas. dan Kabupaten Musi Rawas Utara'),
            array('Pengadilan Negeri Prabumulih','Kota Prabumulih'),
            array('Pengadilan Negeri Pagar Alam','Kota Pagaralam'),
            array('Pengadilan Negeri Pangkalan Balai','Kabupaten Banyuasin')
        );

        echo "Seeder inisialiasi pengadilan negeri dimulai ... ";
        echo "\n";

        // truncate data table
        PengadilanNegeri::truncate();

        foreach ($data as $data_pengadilan_negeri) {
            $insert = PengadilanNegeri::create(['name' => $data_pengadilan_negeri[0], 'wilayah_hukum' => $data_pengadilan_negeri[1]]);
        }

        echo "Seeder inisialiasi pengadilan negeri selesai ... ";
        echo "\n";
    }
}
