<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTersangkadiversiIdToDiversisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diversis', function (Blueprint $table) {
            $table->unsignedBigInteger('tersangkadiversi_id')->after('nama_terdakwa');
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
