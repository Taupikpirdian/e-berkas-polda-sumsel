<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonTahanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_tahanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tahanan_id');
            $table->unsignedBigInteger('lapas_id');
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->unsignedBigInteger('kategori_bagian_id')->nullable();
            $table->string('no_reg_instansi')->nullable();
            $table->timestamp('tgl_peminjaman')->nullable();
            $table->timestamp('tgl_akhir_peminjaman')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('bon_tahanans');
    }
}
