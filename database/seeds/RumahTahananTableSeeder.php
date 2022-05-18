<?php

use Illuminate\Database\Seeder;
use App\RumahTahanan;

class RumahTahananTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // rumah tahanan
        $data = array(
            array('LPKA Kelas I Palembang'),
            array('Lapas Perempuan Kelas IIA Palembang'),
            array('Lapas Narkotika Kelas IIA Muara Beliti'),
            array('Lapas Kelas IIA Lubuk Linggau'),
            array('Lapas Kelas IIA Lahat'),
            array('Lapas Kelas IIA Tanjung Raja'),
            array('Lapas Kelas IIA Banyuasin'),
            array('Lapas Kelas IIB Sekayu'),
            array('Lapas Kelas IIB Muara Enim'),
            array('Lapas Narkotika Kelas IIB Banyuasin'),
            array('Lapas Kelas IIB Kayu Agung'),
            array('Lapas Kelas IIB Martapura'),
            array('Lapas Kelas III Surulangun Rawas'),
            array('Lapas Kelas III Pagar Alam'),
            array('Rutan Kelas I Palembang'),
            array('Rutan Kelas IIB Baturaja'),
        );

        echo "Seeder inisialiasi pengadilan negeri dimulai ... ";
        echo "\n";

        // truncate data table
        RumahTahanan::truncate();

        foreach ($data as $data_tempat_tahanan) {
            $insert = RumahTahanan::create(['name' => $data_tempat_tahanan[0]]);
        }

        echo "Seeder rumah tahanan berhasil ... ";
        echo "\n";
    }
}
