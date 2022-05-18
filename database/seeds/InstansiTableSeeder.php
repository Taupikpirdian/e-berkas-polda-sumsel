<?php

use App\Instansi;
use Illuminate\Database\Seeder;

class InstansiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $instansi = [
            [
                "id" => 1,
                "name" => "KEJAKSAAN TINGGI SUMATERA SELATAN",
            ],
            [
                "id" => 2,
                "name" => "KEJAKSAAN NEGERI PALEMBANG",
            ],
            [
                "id" => 3,
                "name" => "KEJAKSAAN NEGERI OGAN KOMERING ILIR",
            ],
            [
                "id" => 4,
                "name" => "KEJAKSAAN NEGERI OGAN KOMERING ULU",
            ],
            [
                "id" => 5,
                "name" => "KEJAKSAAN NEGERI LAHAT",
            ],
            [
                "id" => 6,
                "name" => "KEJAKSAAN NEGERI LUBUK LINGGAU",
            ],
            [
                "id" => 7,
                "name" => "KEJAKSAAN NEGERI MUARA ENIM",
            ],
            [
                "id" => 8,
                "name" => "KEJAKSAAN NEGERI MUSI BANYUASIN",
            ],
            [
                "id" => 9,
                "name" => "KEJAKSAAN NEGERI PAGAR ALAM",
            ],
            [
                "id" => 10,
                "name" => "KEJAKSAAN NEGERI PRABUMULIH",
            ],
            [
                "id" => 11,
                "name" => "KEJAKSAAN NEGERI BANYUASIN",
            ],
            [
                "id" => 12,
                "name" => "KEJAKSAAN NEGERI EMPAT LAWANG",
            ],
            [
                "id" => 13,
                "name" => "KEJAKSAAN NEGERI PENUKAL ABAB LEMATANG ILIR",
            ],
            [
                "id" => 14,
                "name" => "KEJAKSAAN NEGERI OGAN KOMERING ULU TIMUR",
            ],
            [
                "id" => 15,
                "name" => "KEJAKSAAN NEGERI OGAN KOMERING ULU SELATAN",
            ],
            [
                "id" => 16,
                "name" => "KEJAKSAAN NEGERI OGAN ILIR",
            ],
        ];

        Instansi::truncate();
        Instansi::insert($instansi);
    }
}
