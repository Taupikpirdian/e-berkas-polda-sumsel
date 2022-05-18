<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKategoriToPerpanjanganPenahanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perpanjangan_penahanans', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_bagian_id')->after('id');
            $table->unsignedBigInteger('kategori_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perpanjangan_penahanans', function (Blueprint $table) {
            //
        });
    }
}
