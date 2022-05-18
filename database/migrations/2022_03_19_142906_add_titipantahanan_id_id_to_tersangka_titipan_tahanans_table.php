<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitipantahananIdIdToTersangkaTitipanTahanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tersangka_titipan_tahanans', function (Blueprint $table) {
            $table->unsignedBigInteger('titipantahanan_id')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tersangka_titipan_tahanans', function (Blueprint $table) {
            //
        });
    }
}
