<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerpanjanganPenahanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perpanjangan_penahanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perkara_id');
            $table->string('nomor_t4');
            $table->date('tanggal_t4');
            $table->string('nomor_permintaan_perpanjangan');
            $table->date('tanggal_permintaan_perpanjangan');
            $table->string('uraian_kejadian');
            $table->string('lama_perpanjangan');
            $table->date('tanggal_perpanjangan_penahanan');
            $table->unsignedBigInteger('rumah_tahanan');
            $table->unsignedBigInteger('tanda_tangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perpanjangan_penahanans');
    }
}
