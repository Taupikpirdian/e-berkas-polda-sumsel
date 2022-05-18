<?php

use Illuminate\Database\Seeder;
use App\KategoriBagian;

class KategoriBagianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeder kategori bagian seeder dimulai ... ";
        echo "\n";
        KategoriBagian::truncate();

        // kepolisian

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 1;
        $kategori_bagian->kategori_id = 1;
        $kategori_bagian->name           = 'Polda Sumsel';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 2;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polresta Palembang';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 3;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres Ogan Komering Ilir';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 4;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres Ogan Komering Ulu';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 5;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres Lubuk Linggau';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 6;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres Musi Banyuasin';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 7;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres Lahat';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 8;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres Muara Enim';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 9;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres Pagar Alam';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 10;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres Banyuasin';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 11;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres Prabumulih';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 12;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres Ogan Komering Ulu Timur';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 13;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres Ogan Komering Ulu Selatan';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 14;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres Musi Rawas';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 15;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres Ogan Ilir';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 16;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres Empat Lawang';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 17;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres PALI';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 18;
        $kategori_bagian->kategori_id = 2;
        $kategori_bagian->name           = 'Polres Muratara';
        $kategori_bagian->save();

        // kejaksaan
        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 19;
        $kategori_bagian->kategori_id = 4;
        $kategori_bagian->name           = 'Kejaksaan Negeri Palembang';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 20;
        $kategori_bagian->kategori_id = 4;
        $kategori_bagian->name           = 'Kejaksaan Negeri Banyuasin';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 21;
        $kategori_bagian->kategori_id = 4;
        $kategori_bagian->name = 'Kejaksaan Negeri Musi Banyuasin';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 22;
        $kategori_bagian->kategori_id = 4;
        $kategori_bagian->name = 'Kejaksaan Negeri Muara Enim';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 23;
        $kategori_bagian->kategori_id = 4;
        $kategori_bagian->name = 'Kejaksaan Negeri Lahat';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 24;
        $kategori_bagian->kategori_id = 4;
        $kategori_bagian->name = 'Kejaksaan Negeri Prabumulih';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 25;
        $kategori_bagian->kategori_id = 4;
        $kategori_bagian->name = 'Kejaksaan Negeri Oku';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 26;
        $kategori_bagian->kategori_id = 4;
        $kategori_bagian->name = 'Kejaksaan Negeri Oki';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 27;
        $kategori_bagian->kategori_id = 4;
        $kategori_bagian->name = 'Kejaksaan Negeri Okus';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 28;
        $kategori_bagian->kategori_id = 4;
        $kategori_bagian->name = 'Kejaksaan Negeri Okut';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 29;
        $kategori_bagian->kategori_id = 4;
        $kategori_bagian->name = 'Kejaksaan Negeri Pali';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 30;
        $kategori_bagian->kategori_id = 4;
        $kategori_bagian->name = 'Kejaksaan Negeri Lubuk Linggau';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 31;
        $kategori_bagian->kategori_id = 4;
        $kategori_bagian->name = 'Kejaksaan Negeri Lahat';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 32;
        $kategori_bagian->kategori_id = 4;
        $kategori_bagian->name = 'Kejaksaan Negeri Pagar Alam';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 33;
        $kategori_bagian->kategori_id = 4;
        $kategori_bagian->name = 'Kejaksaan Negeri Ogah Ilir';
        $kategori_bagian->save();

        // pengadilan
        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 34;
        $kategori_bagian->kategori_id = 5;
        $kategori_bagian->name = 'Pengadilan Negeri Palembang';
        $kategori_bagian->alamat = 'Kota Palembang';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 35;
        $kategori_bagian->kategori_id = 5;
        $kategori_bagian->name = 'Pengadilan Negeri Kayu Agung';
        $kategori_bagian->alamat = 'Kabupaten Ogan Komering Ilir dan Kabupaten Ogan Ilir';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 36;
        $kategori_bagian->kategori_id = 5;
        $kategori_bagian->name = 'Pengadilan Negeri Sekayu';
        $kategori_bagian->alamat = 'Kabupaten Kabupaten Musi Banyuasin';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 37;
        $kategori_bagian->kategori_id = 5;
        $kategori_bagian->name = 'Pengadilan Negeri Muara Enim';
        $kategori_bagian->alamat = 'Kabupaten Muaraenim dan Kabupaten Penukal Abab Lematang Ilir';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 38;
        $kategori_bagian->kategori_id = 5;
        $kategori_bagian->name = 'Pengadilan Negeri Baturaja';
        $kategori_bagian->alamat = 'Kabupaten Ogan Komering Ulu, Kabupaten OKU Selatan, dan Kabupaten OK Timur';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 39;
        $kategori_bagian->kategori_id = 5;
        $kategori_bagian->name = 'Pengadilan Negeri Lahat';
        $kategori_bagian->alamat = 'Kabupaten Lahat dan Kabupaten Empat Lawang';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 40;
        $kategori_bagian->kategori_id = 5;
        $kategori_bagian->name = 'Pengadilan Negeri Lubuk Linggau';
        $kategori_bagian->alamat = 'Kabupaten Lubuklinggau, Kabupaten Musi Rawas. dan Kabupaten Musi Rawas Utara';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 41;
        $kategori_bagian->kategori_id = 5;
        $kategori_bagian->name = 'Pengadilan Negeri Prabumulih';
        $kategori_bagian->alamat = 'Kota Prabumulih';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 42;
        $kategori_bagian->kategori_id = 5;
        $kategori_bagian->name = 'Pengadilan Negeri Pagar Alam';
        $kategori_bagian->alamat = 'Kota Pagaralam';
        $kategori_bagian->save();

        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 43;
        $kategori_bagian->kategori_id = 5;
        $kategori_bagian->name = 'Pengadilan Negeri Pangkalan Balai';
        $kategori_bagian->alamat = 'Kabupaten Banyuasin';
        $kategori_bagian->save();

        // hapus setelah ada lapas
        $kategori_bagian = new KategoriBagian();
        $kategori_bagian->id = 44;
        $kategori_bagian->kategori_id = 6;
        $kategori_bagian->name = 'Lapas Testing';
        $kategori_bagian->alamat = 'Kabupaten Banyuasin';
        $kategori_bagian->save();

        echo "Proses seeder selesai. Terimakasih DevOps...";
        echo "\n";
    }
}
