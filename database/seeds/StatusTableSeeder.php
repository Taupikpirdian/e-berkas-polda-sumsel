<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check_data = Status::where(['id' => 1])->first();
        if (!$check_data) {
            $status = new Status();
            $status->id = 1;
            $status->name = 'Open';
            $status->save();
        } else {
            $check_data->name = 'Open';
            $check_data->save();
        }

        $check_data = Status::where(['id' => 2])->first();
        if (!$check_data) {
            $status = new Status();
            $status->id = 2;
            $status->name = 'Progress';
            $status->save();
        } else {
            $check_data->name = 'Progress';
            $check_data->save();
        }

        $check_data = Status::where(['id' => 3])->first();
        if (!$check_data) {
            $status = new Status();
            $status->id = 3;
            $status->name = 'Lengkap';
            $status->save();
        } else {
            $check_data->name = 'Lengkap';
            $check_data->save();
        }

        $check_data = Status::where(['id' => 4])->first();
        if (!$check_data) {
            $status = new Status();
            $status->id = 4;
            $status->name = 'Tahap II';
            $status->save();
        } else {
            $check_data->name = 'Tahap II';
            $check_data->save();
        }

        $check_data = Status::where(['id' => 5])->first();
        if (!$check_data) {
            $status = new Status();
            $status->id = 5;
            $status->name = 'Close';
            $status->save();
        } else {
            $check_data->name = 'Close';
            $check_data->save();
        }

        $check_data = Status::where(['id' => 6])->first();
        if (!$check_data) {
            $status = new Status();
            $status->id = 6;
            $status->name = 'Tahap I';
            $status->save();
        } else {
            $check_data->name = 'Tahap I';
            $check_data->save();
        }

        $check_data = Status::where(['id' => 7])->first();
        if (!$check_data) {
            $status = new Status();
            $status->id = 7;
            $status->name = 'Restorative justice';
            $status->save();
        } else {
            $check_data->name = 'Restorative justice';
            $check_data->save();
        }

        $check_data = Status::where(['id' => 8])->first();
        if (!$check_data) {
            $status = new Status();
            $status->id = 8;
            $status->name = 'SP3';
            $status->save();
        } else {
            $check_data->name = 'SP3';
            $check_data->save();
        }

        $check_data = Status::where(['id' =>98])->first();
        if (!$check_data) {
            $status = new Status();
            $status->id = 9;
            $status->name = 'Limpah';
            $status->save();
        } else {
            $check_data->name = 'Limpah';
            $check_data->save();
        }
    }
}
