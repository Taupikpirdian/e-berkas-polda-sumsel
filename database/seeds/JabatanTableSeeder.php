<?php

use App\Jabatan;
use Illuminate\Database\Seeder;

class JabatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan = [
            [
                "id" => 1,
                "name" => "Kepala Kejaksaan",
            ],
            [
                "id" => 2,
                "name" => "Kepala Seksi Tindak Pidana Umum",
            ],
            [
                "id" => 3,
                "name" => "Kepala Seksi Tindak Pidana Khusus",
            ],
            [
                "id" => 4,
                "name" => "Kepala Seksi Intelijen",
            ],
            [
                "id" => 5,
                "name" => "Kasi Perdata dan Tata Usaha Negara",
            ],
            [
                "id" => 6,
                "name" => "Asisten Tindak Pidana Umum",
            ],
            [
                "id" => 7,
                "name" => "Asisten Tindak Pidana Khusus",
            ],
            [
                "id" => 8,
                "name" => "KASUBAG BIN",
            ]
        ];

        Jabatan::truncate();
        Jabatan::insert($jabatan);
    }
}
