<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLapasIdToTitipanTahanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('titipan_tahanans', function (Blueprint $table) {
            $table->unsignedBigInteger('lapas_id')->after('rumahtahanan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('titipan_tahanans', function (Blueprint $table) {
            //
        });
    }
}
