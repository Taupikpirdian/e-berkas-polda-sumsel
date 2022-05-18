<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTableDiversiAndTableBpactipiring extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diversis', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_bagian_id')->after('nomor_register');
            $table->unsignedBigInteger('kategori_id')->after('nomor_register');
        });

        Schema::table('bpac_tipirings', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_bagian_id')->after('tanggal_register');
            $table->unsignedBigInteger('kategori_id')->after('tanggal_register');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_diversi_and_table_bpactipiring', function (Blueprint $table) {
            //
        });
    }
}
