<?php

use App\MOperator;
use Illuminate\Database\Seeder;

class OperatorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operator = [
            [
                "id" => 1,
                "kode" => "01",
                "name" => "Oharda",
            ],
            [
                "id" => 2,
                "kode" => "02",
                "name" => "Kamneg/Tibum/TPUL",
            ],
            [
                "id" => 3,
                "kode" => "03",
                "name" => "Narkotika",
            ],
            [
                "id" => 4,
                "kode" => "04",
                "name" => "Terorisme dan TPPU",
            ],
            [
                "id" => 5,
                "kode" => "05",
                "name" => "KASI PIDUM",
            ],
            [
                "id" => 6,
                "kode" => "06",
                "name" => "KASI PIDSUS",
            ],
        ];

        MOperator::truncate();
        MOperator::insert($operator);
    }
}
