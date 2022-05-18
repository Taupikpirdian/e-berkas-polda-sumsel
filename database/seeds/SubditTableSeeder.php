<?php

use App\MSubdit;
use Illuminate\Database\Seeder;

class SubditTableSeeder extends Seeder
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
                "type" => "reskrimum",
                "name" => "Subdit Kamneg",
            ],
            [
                "id" => 2,
                "type" => "reskrimum",
                "name" => "Subdit Harda",
            ],
            [
                "id" => 3,
                "type" => "reskrimum",
                "name" => "Subdit Jatanras",
            ],
            [
                "id" => 4,
                "type" => "reskrimum",
                "name" => "Subdit Renakta",
            ],
            [
                "id" => 5,
                "type" => "reskrimsus",
                "name" => "Subdit 1 Indagsi",
            ],
            [
                "id" => 6,
                "type" => "reskrimsus",
                "name" => "Subdit 2 Perbankan",
            ],
            [
                "id" => 7,
                "type" => "reskrimsus",
                "name" => "Subdit 3 Tipidkor",
            ],
            [
                "id" => 8,
                "type" => "reskrimsus",
                "name" => "Subdit 4 Tipidter",
            ],
            [
                "id" => 9,
                "type" => "reskrimsus",
                "name" => "Subdit 5 Siber",
            ],
            [
                "id" => 10,
                "type" => "narkoba",
                "name" => "Subdit 1 Narkoba",
            ],
            [
                "id" => 11,
                "type" => "narkoba",
                "name" => "Subdit 2 Narkoba",
            ],
            [
                "id" => 12,
                "type" => "narkoba",
                "name" => "Subdit 3 Narkoba",
            ],
            [
                "id" => 13,
                "type" => "narkoba",
                "name" => "Team Sus",
            ],
            [
                "id" => 14,
                "type" => "polair",
                "name" => "Kasubdit Gakkum",
            ],
            [
                "id" => 15,
                "type" => "samapta",
                "name" => "Kanit Tipiring",
            ],
            [
                "id" => 16,
                "type" => "polres",
                "name" => "Sat Lantas",
            ],
            [
                "id" => 17,
                "type" => "polres",
                "name" => "Sat Reskrim",
            ],
            [
                "id" => 18,
                "type" => "polres",
                "name" => "Sat Narkoba",
            ],
            [
                "id" => 19,
                "type" => "polres",
                "name" => "Sat Sabara",
            ],
        ];

        MSubdit::truncate();

        MSubdit::insert($tipe);
    }
}
