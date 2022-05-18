<?php

use App\Pangkat;
use Illuminate\Database\Seeder;

class PangkatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeder inisialiasi pangkat dimulai ... ";
        echo "\n";

        $pangkat = [
            [
                "id" => 1,
                "name" => "Jaksa Madya",
                "role" => 'kejaksaan'
            ],
            [
                "id" => 2,
                "name" => "IV/a (Jaksa Madya)",
                "role" => 'kejaksaan'
            ],
            [
                "id" => 3,
                "name" => "Jaksa Pratama",
                "role" => 'kejaksaan'
            ],
            [
                "id" => 4,
                "name" => "Ajun Jaksa",
                "role" => 'kejaksaan'
            ],
            [
                "id" => 5,
                "name" => "Jaksa Utama Pratama",
                "role" => 'kejaksaan'
            ],
            [
                "id" => 6,
                "name" => "Ajuk Jaksa Madya (III/a)",
                "role" => 'kejaksaan'
            ],
            [
                "id" => 7,
                "name" => "Ajun Jaksa (III/b)",
                "role" => 'kejaksaan'
            ],
            [
                "id" => 8,
                "name" => "Jaksa Muda (III/d)",
                "role" => 'kejaksaan'
            ],
            [
                "id" => 9,
                "name" => "Jaksa Muda",
                "role" => 'kejaksaan'
            ],
            [
                "id" => 10,
                "name" => "Ajun Jaksa Madya",
                "role" => 'kejaksaan'
            ],
            [
                "id" => 11,
                "name" => "Ajun Jaksa Pratama",
                "role" => 'kejaksaan'
            ],
            [
                "id" => 12,
                "name" => "Jaksa Utama Muda",
                "role" => 'kejaksaan'
            ],
            [
                "id" => 13,
                "name" => "Irjen Pol",
                "role" => 'kepolisian'
            ],
            [
                "id" => 14,
                "name" => "Brigjen Pol",
                "role" => 'kepolisian'
            ],
            [
                "id" => 15,
                "name" => "KOMBESPOL",
                "role" => 'kepolisian'
            ],
            [
                "id" => 16,
                "name" => "AKBP",
                "role" => 'kepolisian'
            ],
            [
                "id" => 17,
                "name" => "KOMPOL",
                "role" => 'kepolisian'
            ],
            [
                "id" => 18,
                "name" => "AKP",
                "role" => 'kepolisian'
            ],
            [
                "id" => 19,
                "name" => "IPTU",
                "role" => 'kepolisian'
            ],
            [
                "id" => 20,
                "name" => "IPDA",
                "role" => 'kepolisian'
            ],
            [
                "id" => 21,
                "name" => "AIPTU",
                "role" => 'kepolisian'
            ],
            [
                "id" => 22,
                "name" => "AIPDA",
                "role" => 'kepolisian'
            ],
            [
                "id" => 23,
                "name" => "BRIPKA",
                "role" => 'kepolisian'
            ],
            [
                "id" => 24,
                "name" => "BRIGPOL",
                "role" => 'kepolisian'
            ],
            [
                "id" => 25,
                "name" => "BRIPTU",
                "role" => 'kepolisian'
            ],
            [
                "id" => 26,
                "name" => "BRIPDA",
                "role" => 'kepolisian'
            ],
        ];

        Pangkat::truncate();
        Pangkat::insert($pangkat);

        echo "Seeder inisialiasi pangkat selesai ... ";
        echo "\n";
    }
}
