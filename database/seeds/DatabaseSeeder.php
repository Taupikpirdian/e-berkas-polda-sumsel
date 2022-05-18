<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleAndPermissionTableSeeder::class);
        $this->call(KategoriNasionalTableSeeder::class);
        $this->call(KategoriBagianNasionalTableSeeder::class);
        $this->call(KategoriBagianTambahanTableSeeder::class);
        $this->call(KategoriBagianTurunanTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(CodeFileTableSeeder::class);
        $this->call(JenisPidanaSeeder::class);
        $this->call(PangkatTableSeeder::class);
        $this->call(JabatanTableSeeder::class);
        $this->call(InstansiTableSeeder::class);
        $this->call(RumahTahananTableSeeder::class);
        $this->call(JenisPenetapanSeeder::class);
        $this->call(PenggeledahanTerhadapSeeder::class);
        $this->call(OperatorTableSeeder::class);
        $this->call(TipeLembagaTableSeeder::class);
        $this->call(JenisPenahananSeeder::class);
        $this->call(LookupSeeder::class);
        $this->call(WilayahHukumTableSeeder::class);
        $this->call(SubditTableSeeder::class);

        // temporary
        // $this->call(DummyUserTableSeeder::class);
        // $this->call(DummyAksesTableSeeder::class);
        // $this->call(UserGenerateTableSeeder::class);
        // $this->call(JaksaPenuntutUmumTableSeeder::class);
    }
}
