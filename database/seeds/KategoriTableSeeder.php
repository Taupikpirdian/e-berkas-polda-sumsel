<?php

use Illuminate\Database\Seeder;
use App\Kategori;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeder kategori dimulai ... ";
        echo "\n";
        Kategori::truncate();

        $kategori = new Kategori();
        $kategori->id = 1;
        $kategori->name = 'Polda';
        $kategori->save();

        $kategori = new Kategori();
        $kategori->id = 2;
        $kategori->name = 'Polres';
        $kategori->save();

        $kategori = new Kategori();
        $kategori->id = 3;
        $kategori->name = 'Polsek';
        $kategori->save();

        $kategori = new Kategori();
        $kategori->id = 4;
        $kategori->name = 'Kejaksaan';
        $kategori->save();

        $kategori = new Kategori();
        $kategori->id = 5;
        $kategori->name = 'Pengadilan';
        $kategori->save();

        $kategori = new Kategori();
        $kategori->id = 6;
        $kategori->name = 'Kemenkumham';
        $kategori->save();

        echo "Proses seeder selesai. Terimakasih DevOps...";
        echo "\n";
    }
}
