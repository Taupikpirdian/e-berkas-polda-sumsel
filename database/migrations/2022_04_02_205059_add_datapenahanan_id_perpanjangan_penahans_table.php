<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatapenahananIdPerpanjanganPenahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perpanjangan_penahanans', function (Blueprint $table) {
            $table->unsignedBigInteger('datapenahanan_id')->after('kategori_bagian_id');
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
