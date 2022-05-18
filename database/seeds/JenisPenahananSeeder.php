<?php

use App\JenisPenahanan;
use Illuminate\Database\Seeder;

class JenisPenahananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // jenis penahanan
        $data = array(
            array('Tahanan Kota'),
            array('Tahanan Rumah'),
            array('Tahanan Tahanan'),
        );

        echo "Seeder jenis penahanan dimulai ... ";
        echo "\n";

        // truncate data table
        JenisPenahanan::truncate();

        foreach ($data as $data_jenis_penahanan) {
            JenisPenahanan::create(['name' => $data_jenis_penahanan[0]]);
        }

        echo "Seeder jenis penahanan berhasil ... ";
        echo "\n";
    }
}
