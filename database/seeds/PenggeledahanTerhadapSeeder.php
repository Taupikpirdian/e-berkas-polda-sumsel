<?php

use App\PenggeledahanTerhadap;
use Illuminate\Database\Seeder;

class PenggeledahanTerhadapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check_data = PenggeledahanTerhadap::where(['id' => 1])->first();
        if (!$check_data) {
            $status = new PenggeledahanTerhadap();
            $status->id = 1;
            $status->name = 'Badan Dan Atau Pakaian';
            $status->save();
        } else {
            $check_data->name = 'Badan Dan Atau Pakaian';
            $check_data->save();
        }

        $check_data = PenggeledahanTerhadap::where(['id' => 2])->first();
        if (!$check_data) {
            $status = new PenggeledahanTerhadap();
            $status->id = 2;
            $status->name = 'Rumah Tempat Tinggal';
            $status->save();
        } else {
            $check_data->name = 'Rumah Tempat Tinggal';
            $check_data->save();
        }

        $check_data = PenggeledahanTerhadap::where(['id' => 3])->first();
        if (!$check_data) {
            $status = new PenggeledahanTerhadap();
            $status->id = 3;
            $status->name = 'Tempat Tertutup Lainnya';
            $status->save();
        } else {
            $check_data->name = 'Tempat Tertutup Lainnya';
            $check_data->save();
        }

        $check_data = PenggeledahanTerhadap::where(['id' => 99])->first();
        if (!$check_data) {
            $status = new PenggeledahanTerhadap();
            $status->id = 99;
            $status->name = 'Lain-lain';
            $status->save();
        } else {
            $check_data->name = 'Lain-lain';
            $check_data->save();
        }
    }
}
