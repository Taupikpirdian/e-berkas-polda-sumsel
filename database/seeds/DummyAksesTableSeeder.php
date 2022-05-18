<?php

use Illuminate\Database\Seeder;
use App\Akses;
use App\User;

class DummyAksesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeder akses seeder dimulai ... ";
        echo "\n";
        Akses::truncate();

        // kepolisian - Dummy 1-5
        $check_user = User::where(['email' => 'kepolisian01@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 2242;
            $akses->save();
        }

        $check_user = User::where(['email' => 'kepolisian02@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 2248;
            $akses->save();
        }

        $check_user = User::where(['email' => 'kepolisian03@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 2285;
            $akses->save();
        }

        $check_user = User::where(['email' => 'kepolisian04@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 2410;
            $akses->save();
        }

        $check_user = User::where(['email' => 'kepolisian05@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 2352;
            $akses->save();
        }

        // kejaksaan - Dummy 1-5
        $check_user = User::where(['email' => 'kejaksaan01@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 510;
            $akses->save();
        }

        $check_user = User::where(['email' => 'kejaksaan02@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 519;
            $akses->save();
        }

        $check_user = User::where(['email' => 'kejaksaan03@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 516;
            $akses->save();
        }

        $check_user = User::where(['email' => 'kejaksaan04@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 515;
            $akses->save();
        }

        $check_user = User::where(['email' => 'kejaksaan05@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 513;
            $akses->save();
        }

        // Pengadilan - Dummy 1-5
        $check_user = User::where(['email' => 'pengadilan01@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 149;
            $akses->save();
        }

        $check_user = User::where(['email' => 'pengadilan02@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 150;
            $akses->save();
        }

        $check_user = User::where(['email' => 'pengadilan03@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 155;
            $akses->save();
        }

        $check_user = User::where(['email' => 'pengadilan04@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 154;
            $akses->save();
        }

        $check_user = User::where(['email' => 'pengadilan05@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 151;
            $akses->save();
        }

        $check_user = User::where(['email' => 'lapas01@yopmail.com'])->first();
        if ($check_user) {
            $akses = new Akses();
            $akses->user_id = $check_user->id;
            $akses->kategori_bagian_id = 44;
            $akses->save();
        }

        echo "Proses seeder selesai. Terimakasih DevOps...";
        echo "\n";
    }
}
