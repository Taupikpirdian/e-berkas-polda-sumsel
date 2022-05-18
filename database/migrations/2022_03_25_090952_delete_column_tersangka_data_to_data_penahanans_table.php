<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnTersangkaDataToDataPenahanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_penahanans', function (Blueprint $table) {
            $table->dropColumn('nama_tersangka');
            $table->dropColumn('tanggal_register');
            $table->dropColumn('tempat_lahir');
            $table->dropColumn('tempat_tinggal');  
            $table->dropColumn('tanggal_lahir');  
            $table->dropColumn('jenis_kelamin');  
            $table->dropColumn('agama');  
            $table->dropColumn('kebangsaan');  
            $table->dropColumn('kejaksaan');  
            $table->dropColumn('perkara_id');  
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
