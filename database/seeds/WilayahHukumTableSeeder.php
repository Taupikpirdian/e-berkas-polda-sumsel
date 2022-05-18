<?php

use App\WilayahHukum;
use Illuminate\Database\Seeder;

class WilayahHukumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeder wilayah hukum dimulai ... ";
        echo "\n";

        $kepolisianKejaksaan = [
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07",
                "kode_relasi" => "006.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.00.00.13",
                "kode_relasi" => "006.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.00.00.15",
                "kode_relasi" => "006.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.00.00.16",
                "kode_relasi" => "006.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.00.00.17",
                "kode_relasi" => "006.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.00.00.20",
                "kode_relasi" => "006.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.00.00.21",
                "kode_relasi" => "006.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.00.00.22",
                "kode_relasi" => "006.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.00.08",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.00.10",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.00.11",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.00.14",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.01",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.02",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.03",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.04",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.05",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.06",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.07",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.08",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.09",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.10",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.11",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.12",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.13",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.01.14",
                "kode_relasi" => "006.06.01"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.00.08",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.00.10",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.00.11",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.00.14",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.01",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.02",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.03",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.04",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.05",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.06",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.07",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.08",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.09",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.10",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.11",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.12",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.02.13",
                "kode_relasi" => "006.06.07"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.00.08",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.00.10",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.00.11",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.00.14",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.01",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.02",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.03",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.04",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.05",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.06",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.07",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.08",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.09",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.10",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.11",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.12",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.13",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.14",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.15",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.03.16",
                "kode_relasi" => "006.06.02"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.00.08",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.00.10",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.00.11",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.00.14",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.01",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.02",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.03",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.04",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.05",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.06",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.07",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.08",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.09",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.10",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.11",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.12",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.13",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.04.14",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.05",
                "kode_relasi" => "006.06.11"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.05.00.08",
                "kode_relasi" => "006.06.11"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.05.00.10",
                "kode_relasi" => "006.06.11"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.05.00.11",
                "kode_relasi" => "006.06.11"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.05.00.14",
                "kode_relasi" => "006.06.11"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.05.01",
                "kode_relasi" => "006.06.11"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.05.02",
                "kode_relasi" => "006.06.11"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.05.03",
                "kode_relasi" => "006.06.11"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.05.04",
                "kode_relasi" => "006.06.11"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.05.05",
                "kode_relasi" => "006.06.11"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.05.06",
                "kode_relasi" => "006.06.11"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.05.07",
                "kode_relasi" => "006.06.11"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.06",
                "kode_relasi" => "006.06.15"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.06.00.08",
                "kode_relasi" => "006.06.15"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.06.00.10",
                "kode_relasi" => "006.06.15"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.06.00.11",
                "kode_relasi" => "006.06.15"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.06.00.14",
                "kode_relasi" => "006.06.15"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.06.01",
                "kode_relasi" => "006.06.15"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.06.02",
                "kode_relasi" => "006.06.15"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.06.03",
                "kode_relasi" => "006.06.15"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.06.04",
                "kode_relasi" => "006.06.15"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.06.05",
                "kode_relasi" => "006.06.15"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.06.06",
                "kode_relasi" => "006.06.15"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.06.07",
                "kode_relasi" => "006.06.15"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.06.08",
                "kode_relasi" => "006.06.15"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.06.09",
                "kode_relasi" => "006.06.15"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.06.10",
                "kode_relasi" => "006.06.15"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.07",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.07.00.08",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.07.00.10",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.07.00.11",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.07.00.14",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.07.01",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.07.02",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.07.03",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.07.04",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.00.08",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.00.10",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.00.11",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.00.14",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.01",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.02",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.03",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.04",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.05",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.06",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.07",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.08",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.09",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.10",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.11",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.12",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.13",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.08.14",
                "kode_relasi" => "006.06.10"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.09",
                "kode_relasi" => "006.06.08"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.09.00.08",
                "kode_relasi" => "006.06.08"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.09.00.10",
                "kode_relasi" => "006.06.08"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.09.00.11",
                "kode_relasi" => "006.06.08"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.09.00.14",
                "kode_relasi" => "006.06.08"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.09.01",
                "kode_relasi" => "006.06.08"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.09.02",
                "kode_relasi" => "006.06.08"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.09.03",
                "kode_relasi" => "006.06.08"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.09.04",
                "kode_relasi" => "006.06.08"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.09.05",
                "kode_relasi" => "006.06.08"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.10",
                "kode_relasi" => "006.06.16"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.10.00.08",
                "kode_relasi" => "006.06.16"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.10.00.10",
                "kode_relasi" => "006.06.16"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.10.00.11",
                "kode_relasi" => "006.06.16"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.10.00.14",
                "kode_relasi" => "006.06.16"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.10.01",
                "kode_relasi" => "006.06.16"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.10.02",
                "kode_relasi" => "006.06.16"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.10.03",
                "kode_relasi" => "006.06.16"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.10.04",
                "kode_relasi" => "006.06.16"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.10.05",
                "kode_relasi" => "006.06.16"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.10.06",
                "kode_relasi" => "006.06.16"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.11",
                "kode_relasi" => "006.06.09"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.11.00.08",
                "kode_relasi" => "006.06.09"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.11.00.10",
                "kode_relasi" => "006.06.09"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.11.00.11",
                "kode_relasi" => "006.06.09"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.11.00.14",
                "kode_relasi" => "006.06.09"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.11.01",
                "kode_relasi" => "006.06.09"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.11.02",
                "kode_relasi" => "006.06.09"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.11.03",
                "kode_relasi" => "006.06.09"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.11.04",
                "kode_relasi" => "006.06.09"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12.00.08",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12.00.10",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12.00.11",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12.00.14",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12.01",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12.02",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12.03",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12.04",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12.05",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12.06",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12.07",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12.08",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12.09",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12.10",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.12.11",
                "kode_relasi" => "006.06.03"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.13",
                "kode_relasi" => "006.06.14"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.13.00.08",
                "kode_relasi" => "006.06.14"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.13.00.10",
                "kode_relasi" => "006.06.14"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.13.00.11",
                "kode_relasi" => "006.06.14"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.13.00.14",
                "kode_relasi" => "006.06.14"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.13.01",
                "kode_relasi" => "006.06.14"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.13.02",
                "kode_relasi" => "006.06.14"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.13.03",
                "kode_relasi" => "006.06.14"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.13.04",
                "kode_relasi" => "006.06.14"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.13.05",
                "kode_relasi" => "006.06.14"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.13.06",
                "kode_relasi" => "006.06.14"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.13.07",
                "kode_relasi" => "006.06.14"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.13.08",
                "kode_relasi" => "006.06.14"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.13.09",
                "kode_relasi" => "006.06.14"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.13.10",
                "kode_relasi" => "006.06.14"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.00.08",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.00.10",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.00.11",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.00.14",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.01",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.02",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.03",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.04",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.05",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.06",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.07",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.08",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.09",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.10",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.11",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.12",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.13",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.14",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.14.15",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.00.08",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.00.10",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.00.11",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.00.14",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.01",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.02",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.03",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.04",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.05",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.06",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.07",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.08",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.09",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.10",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.11",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.15.12",
                "kode_relasi" => "006.06.04"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.16",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.16.00.08",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.16.00.10",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.16.00.11",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.16.00.14",
                "kode_relasi" => "006.06.05"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.17",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.17.00.08",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.17.00.10",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.17.00.11",
                "kode_relasi" => "006.06.06"
            ],
            [
                "role" => "kepolisian-kejaksaan",
                "kode_induk" => "060.01.07.17.00.14",
                "kode_relasi" => "006.06.06"
            ],
        ];

        $kepolisianPengadilan = [
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07",
                "kode_relasi" => "005.098938",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.01",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.01.01",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.01.02",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.01.03",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.01.04",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.01.05",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.01.06",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.01.07",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.01.08",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.01.09",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.01.10",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.01.11",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.01.12",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.01.13",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.01.14",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.02",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.02.01",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.02.02",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.02.03",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.02.04",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.02.05",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.02.06",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.02.07",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.02.08",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.02.09",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.02.10",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.02.11",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.02.12",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.02.13",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.01",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.02",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.03",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.04",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.05",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.06",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.07",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.08",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.09",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.10",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.11",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.12",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.13",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.14",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.15",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.03.16",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.04",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.04.01",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.04.02",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.04.03",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.04.04",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.04.05",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.04.06",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.04.07",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.04.08",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.04.09",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.04.10",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.04.11",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.04.12",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.04.13",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.04.14",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.05",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.05.01",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.05.02",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.05.03",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.05.04",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.05.05",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.05.06",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.05.07",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.06",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.06.01",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.06.02",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.06.03",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.06.04",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.06.05",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.06.06",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.06.07",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.06.08",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.06.09",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.06.10",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.07",
                "kode_relasi" => "005.098970",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.07.01",
                "kode_relasi" => "005.098970",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.07.02",
                "kode_relasi" => "005.098970",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.07.03",
                "kode_relasi" => "005.098970",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.07.04",
                "kode_relasi" => "005.098970",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.08",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.08.01",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.08.02",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.08.03",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.08.04",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.08.05",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.08.06",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.08.07",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.08.08",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.08.09",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.08.10",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.08.11",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.08.12",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.08.13",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.08.14",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.09",
                "kode_relasi" => "005.672969",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.09.01",
                "kode_relasi" => "005.672969",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.09.02",
                "kode_relasi" => "005.672969",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.09.03",
                "kode_relasi" => "005.672969",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.09.04",
                "kode_relasi" => "005.672969",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.09.05",
                "kode_relasi" => "005.672969",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.10",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.10.01",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.10.02",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.10.03",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.10.04",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.10.05",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.10.06",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.11",
                "kode_relasi" => "005.672952",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.11.01",
                "kode_relasi" => "005.672952",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.11.02",
                "kode_relasi" => "005.672952",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.11.03",
                "kode_relasi" => "005.672952",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.11.04",
                "kode_relasi" => "005.672952",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.12",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.12.01",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.12.02",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.12.03",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.12.04",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.12.05",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.12.06",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.12.07",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.12.08",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.12.09",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.12.10",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.12.11",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.13",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.13.01",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.13.02",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.13.03",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.13.04",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.13.05",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.13.06",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.13.07",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.13.08",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.13.09",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.13.10",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14.01",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14.02",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14.03",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14.04",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14.05",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14.06",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14.07",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14.08",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14.09",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14.10",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14.11",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14.12",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14.13",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14.14",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.14.15",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.15",
                "kode_relasi" => "005.098984",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.15.01",
                "kode_relasi" => "005.098984",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.15.02",
                "kode_relasi" => "005.098984",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.15.03",
                "kode_relasi" => "005.098984",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.15.04",
                "kode_relasi" => "005.098984",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.15.05",
                "kode_relasi" => "005.098984",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.15.06",
                "kode_relasi" => "005.098984",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.15.07",
                "kode_relasi" => "005.098984",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.15.08",
                "kode_relasi" => "005.098984",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.15.09",
                "kode_relasi" => "005.098984",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.15.10",
                "kode_relasi" => "005.098984",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.15.11",
                "kode_relasi" => "005.098984",
            ],
            [
                "role" => "kepolisian-pengadilan",
                "kode_induk" => "060.01.07.15.12",
                "kode_relasi" => "005.098984",
            ],
        ];

        $kejaksaanPengadilan = [
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06",
                "kode_relasi" => "005.098938",
            ],
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06.01",
                "kode_relasi" => "005.098942",
            ],
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06.02",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06.03",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06.04",
                "kode_relasi" => "005.098984",
            ],
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06.05",
                "kode_relasi" => "005.098970",
            ],
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06.06",
                "kode_relasi" => "005.098991",
            ],
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06.07",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06.08",
                "kode_relasi" => "005.672969",
            ],
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06.09",
                "kode_relasi" => "005.672952",
            ],
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06.10",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06.11",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06.13",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06.14",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06.15",
                "kode_relasi" => NULL,
            ],
            [
                "role" => "kejaksaan-pengadilan",
                "kode_induk" => "006.06.16",
                "kode_relasi" => NULL,
            ],
        ];

        WilayahHukum::truncate();
        WilayahHukum::insert($kepolisianKejaksaan);

        echo "Seeder wilayah hukum selesai ... ";
        echo "\n";
    }
}
