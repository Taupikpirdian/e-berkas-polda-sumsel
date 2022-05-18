<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTersangkaBpacTipirings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tersangka_bpac_tipirings', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable()->after('id_bpac_tipiring');
            $table->date('tgl_lahir')->nullable();
            $table->string('jk')->nullable();
            $table->string('kebangsaan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('agama')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pasal')->nullable();
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
            //
        });
    }
}
