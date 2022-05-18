<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriBagianTurunansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_bagian_turunans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_induk')->nullable();
            $table->string('kode_turunan')->nullable();
            $table->string('tipe_turunan')->comment('polda, polres, kejati');
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
        Schema::dropIfExists('kategori_bagian_turunans');
    }
}
