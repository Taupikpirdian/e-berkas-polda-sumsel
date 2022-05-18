<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToBpacTipiringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bpac_tipirings', function (Blueprint $table) {
            $table->unsignedBigInteger('pengadilan_id')->after('penyidik_id');
            $table->tinyInteger('status')->default('1')->before('original_name')->comment('1=pengaju; 2=balasan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bpac_tipirings', function (Blueprint $table) {
            //
        });
    }
}
