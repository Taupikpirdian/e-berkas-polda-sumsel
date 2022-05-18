<?php

use App\MTipeLembaga;
use Illuminate\Database\Seeder;

class TipeLembagaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipe = [
            [
                "id" => 1,
                "kode" => "",
                "name" => "Polda",
            ],
            [
                "id" => 2,
                "kode" => "",
                "name" => "Polres",
            ],
            [
                "id" => 3,
                "kode" => "",
                "name" => "Polsek",
            ],
            [
                "id" => 4,
                "kode" => "",
                "name" => "Kejaksaan Tinggi",
            ],
            [
                "id" => 5,
                "kode" => "",
                "name" => "Kejaksaan Negeri",
            ],
            [
                "id" => 6,
                "kode" => "",
                "name" => "Pengadilan Tinggi",
            ],
            [
                "id" => 7,
                "kode" => "",
                "name" => "Pengadilan Negeri",
            ],
            [
                "id" => 8,
                "kode" => "",
                "name" => "Lapas",
            ],
            [
                "id" => 9,
                "kode" => "",
                "name" => "Direktorat Polda",
            ],
            [
                "id" => 10,
                "kode" => "",
                "name" => "Satuan Polres",
            ],
        ];

        MTipeLembaga::truncate();
        MTipeLembaga::insert($tipe);
    }
}
