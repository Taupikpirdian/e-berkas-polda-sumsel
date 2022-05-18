<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTitipanTahanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('titipan_tahanans', function (Blueprint $table) {
            $table->tinyInteger('code')->after('rumahtahanan_id')->comment('1=pengaju; 2=balasan');
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
