<?php

use App\Lookup;
use Illuminate\Database\Seeder;

class LookupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lookup
        $data = array(
            array('Anak', 'jenis_penahanan'),
            array('Dewasa', 'jenis_penahanan'),
            array('Kejaksaan', 'jenis_lembaga'),
            array('Pengadilan', 'jenis_lembaga')
        );

        echo "Seeder Lookup dimulai ... ";
        echo "\n";

        // truncate data table
        Lookup::truncate();

        foreach ($data as $Lookup) {
            Lookup::create(['name' => $Lookup[0], 'type' => $Lookup[1]]);
        }

        echo "Seeder Lookup berhasil ... ";
        echo "\n";
    }
}
