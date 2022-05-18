<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPenahanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_penahanans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_register')->nullable();
            $table->string('jenis_penahanan')->nullable();
            $table->unsignedBigInteger('satuan_kerja')->nullable();
            $table->date('tanggal_surat_pengajuan')->nullable();
            $table->string('no_surat_pengajuan')->nullable();
            $table->date('waktu_penahanan_habis')->nullable();
            $table->unsignedBigInteger('jenis_tempat_penahanan')->nullable();
            $table->string('tindak_pidana_tersangka')->nullable();
            $table->string('nomor_surat_perintah_penahanan')->nullable();
            $table->string('nomor_surat_kepanjangan')->nullable();
            $table->string('nama_tersangka')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tempat_tinggal')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('agama')->nullable();
            $table->string('kebangsaan')->nullable();
            $table->string('kejaksaan')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('data_penahanans');
    }
}
