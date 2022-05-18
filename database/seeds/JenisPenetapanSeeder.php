<?php

use App\JenisPenetapan;
use Illuminate\Database\Seeder;

class JenisPenetapanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check_data = JenisPenetapan::where(['id' => 1])->first();
        if (!$check_data) {
            $status = new JenisPenetapan();
            $status->id = 1;
            $status->type = 'izin-sita';
            $status->name = 'Penetapan Izin Penyitaan';
            $status->save();
        } else {
            $check_data->name = 'Penetapan Izin Penyitaan';
            $check_data->save();
        }

        $check_data = JenisPenetapan::where(['id' => 2])->first();
        if (!$check_data) {
            $status = new JenisPenetapan();
            $status->id = 2;
            $status->type = 'izin-sita';
            $status->name = 'Penetapan Persetujuan Penyitaan';
            $status->save();
        } else {
            $check_data->name = 'Penetapan Persetujuan Penyitaan';
            $check_data->save();
        }

        $check_data = JenisPenetapan::where(['id' => 3])->first();
        if (!$check_data) {
            $status = new JenisPenetapan();
            $status->id = 3;
            $status->type = 'izin-sita';
            $status->name = 'Penetapan Izin Penyitaan Khusus Pasal 43';
            $status->save();
        } else {
            $check_data->name = 'Penetapan Izin Penyitaan Khusus Pasal 43';
            $check_data->save();
        }

        $check_data = JenisPenetapan::where(['id' => 4])->first();
        if (!$check_data) {
            $status = new JenisPenetapan();
            $status->id = 4;
            $status->type = 'izin-sita';
            $status->name = 'Penetapan Penolakan Izin Penyitaan';
            $status->save();
        } else {
            $check_data->name = 'Penetapan Penolakan Izin Penyitaan';
            $check_data->save();
        }

        $check_data = JenisPenetapan::where(['id' => 5])->first();
        if (!$check_data) {
            $status = new JenisPenetapan();
            $status->id = 5;
            $status->type = 'izin-geledah';
            $status->name = 'Penetapan Izin Penggeledahan';
            $status->save();
        } else {
            $check_data->name = 'Penetapan Izin Penggeledahan';
            $check_data->save();
        }

        $check_data = JenisPenetapan::where(['id' => 6])->first();
        if (!$check_data) {
            $status = new JenisPenetapan();
            $status->id = 6;
            $status->type = 'izin-geledah';
            $status->name = 'Penetapan Persetujuan Penggeledahan';
            $status->save();
        } else {
            $check_data->name = 'Penetapan Persetujuan Penggeledahan';
            $check_data->save();
        }

        $check_data = JenisPenetapan::where(['id' => 7])->first();
        if (!$check_data) {
            $status = new JenisPenetapan();
            $status->id = 7;
            $status->type = 'izin-geledah';
            $status->name = 'Penetapan Penolakan Izin Penggeledahan';
            $status->save();
        } else {
            $check_data->name = 'Penetapan Penolakan Izin Penggeledahan';
            $check_data->save();
        }
    }
}
