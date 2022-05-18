<?php

use App\User;
use App\JaksaPenuntutUmum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeder user dummy kepolisian seeder dimulai ... ";
        echo "\n";
        echo "Create user dummy kepolisian";
        echo "\n";

        // User Dummy Kepolisian
        $check_user = User::where(['email' => 'kepolisian01@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Kepolisian 01',
                    'email'  => 'kepolisian01@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('kepolisian');
        }

        // User Dummy Kepolisian
        $check_user = User::where(['email' => 'kepolisian02@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Kepolisian 02',
                    'email'  => 'kepolisian02@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('kepolisian');
        }

        // User Dummy Kepolisian
        $check_user = User::where(['email' => 'kepolisian03@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Kepolisian 03',
                    'email'  => 'kepolisian03@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('kepolisian');
        }

        // User Dummy Kepolisian
        $check_user = User::where(['email' => 'kepolisian04@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Kepolisian 04',
                    'email'  => 'kepolisian04@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('kepolisian');
        }

        // User Dummy Kepolisian
        $check_user = User::where(['email' => 'kepolisian05@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Kepolisian 05',
                    'email'  => 'kepolisian05@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('kepolisian');
        }

        // User Kejaksaan
        $check_user = User::where(['email' => 'kejaksaan01@yopmail.com'])->first();
        if (!$check_user) {
            $check_user = User::create(
                [
                    'name'  => 'kejaksaan 01',
                    'email'  => 'kejaksaan01@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $check_user->assignRole('kejaksaan');

            // assign jaksa
            $jaksa = JaksaPenuntutUmum::where(['nip' => '196110271988031003'])->first();
            if ($jaksa) {
                $jaksa->user_id = $check_user->id;
                $jaksa->save();
            }
        }

        // User Dummy kejaksaan
        $check_user = User::where(['email' => 'kejaksaan02@yopmail.com'])->first();
        if (!$check_user) {
            $check_user = User::create(
                [
                    'name'  => 'kejaksaan 02',
                    'email'  => 'kejaksaan02@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $check_user->assignRole('kejaksaan');

            // assign jaksa
            $jaksa = JaksaPenuntutUmum::where(['nip' => '198202212006032001'])->first();
            if ($jaksa) {
                $jaksa->user_id = $check_user->id;
                $jaksa->save();
            }
        }

        // User Dummy kejaksaan
        $check_user = User::where(['email' => 'kejaksaan03@yopmail.com'])->first();
        if (!$check_user) {
            $check_user = User::create(
                [
                    'name'  => 'kejaksaan 03',
                    'email'  => 'kejaksaan03@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $check_user->assignRole('kejaksaan');

            // assign jaksa
            $jaksa = JaksaPenuntutUmum::where(['nip' => '198706122006041001'])->first();
            if ($jaksa) {
                $jaksa->user_id = $check_user->id;
                $jaksa->save();
            }
        }

        // User Dummy kejaksaan
        $check_user = User::where(['email' => 'kejaksaan04@yopmail.com'])->first();
        if (!$check_user) {
            $check_user = User::create(
                [
                    'name'  => 'kejaksaan 04',
                    'email'  => 'kejaksaan04@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $check_user->assignRole('kejaksaan');

            // assign jaksa
            $jaksa = JaksaPenuntutUmum::where(['nip' => '198612102005012001'])->first();
            if ($jaksa) {
                $jaksa->user_id = $check_user->id;
                $jaksa->save();
            }
        }

        // User Dummy kejaksaan
        $check_user = User::where(['email' => 'kejaksaan05@yopmail.com'])->first();
        if (!$check_user) {
            $check_user = User::create(
                [
                    'name'  => 'kejaksaan 05',
                    'email'  => 'kejaksaan05@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $check_user->assignRole('kejaksaan');

            // assign jaksa
            $jaksa = JaksaPenuntutUmum::where(['nip' => '197708032001122002'])->first();
            if ($jaksa) {
                $jaksa->user_id = $check_user->id;
                $jaksa->save();
            }
        }

        // User Dummy Pengadilan
        $check_user = User::where(['email' => 'pengadilan01@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Pengadilan 01',
                    'email'  => 'pengadilan01@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('pengadilan');
        }

        // User Dummy Pengadilan
        $check_user = User::where(['email' => 'pengadilan02@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Pengadilan 02',
                    'email'  => 'pengadilan02@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('pengadilan');
        }

        // User Dummy Pengadilan
        $check_user = User::where(['email' => 'pengadilan03@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Pengadilan 03',
                    'email'  => 'pengadilan03@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('pengadilan');
        }

        // User Dummy Pengadilan
        $check_user = User::where(['email' => 'pengadilan04@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Pengadilan 04',
                    'email'  => 'pengadilan04@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('pengadilan');
        }

        // User Dummy Pengadilan
        $check_user = User::where(['email' => 'pengadilan05@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Pengadilan 05',
                    'email'  => 'pengadilan05@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('pengadilan');
        }

        // User Dummy Lapas
        // admin
        $check_user = User::where(['email' => 'admin-lapas@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Admin Lapas',
                    'email'  => 'admin-lapas@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('admin-lapas');
        }

        // 01
        $check_user = User::where(['email' => 'lapas01@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Lapas 01',
                    'email'  => 'lapas01@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('lapas');
        }

        // 02
        $check_user = User::where(['email' => 'lapas02@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Lapas 02',
                    'email'  => 'lapas02@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('lapas');
        }

        // 03
        $check_user = User::where(['email' => 'lapas03@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Lapas 03',
                    'email'  => 'lapas03@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('lapas');
        }

        // 04
        $check_user = User::where(['email' => 'lapas04@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Lapas 04',
                    'email'  => 'lapas04@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('lapas');
        }

        // 05
        $check_user = User::where(['email' => 'lapas05@yopmail.com'])->first();
        if (!$check_user) {
            $user = User::create(
                [
                    'name'  => 'Lapas 05',
                    'email'  => 'lapas05@yopmail.com',
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $user->assignRole('lapas');
        }

        echo "Proses seeder selesai. Terimakasih DevOps...";
        echo "\n";
    }
}
