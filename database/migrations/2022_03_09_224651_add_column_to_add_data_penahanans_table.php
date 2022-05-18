<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToAddDataPenahanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_penahanans', function (Blueprint $table) {
            $table->unsignedBigInteger('perkara_id')->after('jenis_penahanan')->nullable();
            $table->unsignedBigInteger('pengadilan_id')->after('perkara_id');
            $table->integer('type_tersangka')->after('pengadilan_id');
            $table->integer('status')->after('type_tersangka');
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
