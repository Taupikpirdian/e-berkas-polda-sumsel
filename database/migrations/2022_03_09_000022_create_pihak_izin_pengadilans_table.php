<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePihakIzinPengadilansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pihak_izin_pengadilans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('izin_pengadilan_id');
            $table->string('jns_pihak')->nullable();
            $table->string('nik')->nullable();
            $table->string('name')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('jk')->nullable();
            $table->string('kebangsaan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('agama')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('pendidikan')->nullable();
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
        Schema::dropIfExists('pihak_izin_pengadilans');
    }
}
