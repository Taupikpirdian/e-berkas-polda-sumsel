<?php

use Illuminate\Database\Seeder;
use App\Kategori;

class KategoriNasionalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeder kategori se-nasional dimulai ... ";
        echo "\n";
        Kategori::truncate();

        $kategori = new Kategori();
        $kategori->id = 1;
        $kategori->name = 'Mahkamah Agung';
        $kategori->save();

        $kategori = new Kategori();
        $kategori->id = 2;
        $kategori->name = 'Pengadilan';
        $kategori->save();

        $kategori = new Kategori();
        $kategori->id = 3;
        $kategori->name = 'Kejaksaan';
        $kategori->save();

        $kategori = new Kategori();
        $kategori->id = 4;
        $kategori->name = 'Kemenkumham';
        $kategori->save();

        $kategori = new Kategori();
        $kategori->id = 5;
        $kategori->name = 'Kepolisian';
        $kategori->save();

        $kategori = new Kategori();
        $kategori->id = 6;
        $kategori->name = 'BNN';
        $kategori->save();

        $kategori = new Kategori();
        $kategori->id = 7;
        $kategori->name = 'KPK';
        $kategori->save();

        echo "Proses seeder se-nasional selesai. Terimakasih DevOps...";
        echo "\n";
    }
}
