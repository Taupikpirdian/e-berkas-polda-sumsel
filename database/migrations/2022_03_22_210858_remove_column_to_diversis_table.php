<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnToDiversisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diversis', function (Blueprint $table) {
            $table->dropColumn('nama_terdakwa');
            $table->dropColumn('tanggal_register');
            $table->dropColumn('tersangkadiversi_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diversis', function (Blueprint $table) {
            //
        });
    }
}
