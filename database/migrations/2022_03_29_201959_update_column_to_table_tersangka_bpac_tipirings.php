<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnToTableTersangkaBpacTipirings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tersangka_bpac_tipirings', function (Blueprint $table) {
            $table->string('nik')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tersangka_bpac_tipirings', function (Blueprint $table) {
            $table->dropColumn('nik');
        });
    }
}
