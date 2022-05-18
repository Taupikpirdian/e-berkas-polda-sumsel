<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTypeBagianIdToDataPenahanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_penahanans', function (Blueprint $table) {
            $table->unsignedBigInteger('typebagian_id')->after('type_tersangka');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_penahanans', function (Blueprint $table) {
            //
        });
    }
}
