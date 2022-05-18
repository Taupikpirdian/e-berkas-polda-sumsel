<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinPengadilansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izin_pengadilans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perkara_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jns_penetapan_id')->nullable();
            $table->unsignedBigInteger('penggeledahan_terhadap_id')->nullable();
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->unsignedBigInteger('kategori_bagian_id')->nullable();
            $table->unsignedBigInteger('pengadilan_id')->nullable();
            $table->date('tgl_surat_permohonan')->nullable();
            $table->string('no_surat_permohonan')->nullable();
            $table->date('tgl_surat_perintah')->nullable();
            $table->string('no_surat_perintah')->nullable();
            $table->date('tgl_lapor')->nullable();
            $table->string('no_lapor')->nullable();
            $table->date('tgl_ba')->nullable();
            $table->string('no_ba')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('jns_izin')->comment('izin-sita or izin-geledah');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('izin_pengadilans');
    }
}
