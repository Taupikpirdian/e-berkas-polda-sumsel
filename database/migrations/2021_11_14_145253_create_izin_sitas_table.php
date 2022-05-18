<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinSitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izin_sitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('no_lp');
            $table->date('date_no_lp');
            $table->string('penyidik')->nullable();
            $table->string('nrp')->nullable();
            $table->string('no_hp')->nullable();
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('kategori_bagian_id');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('izin_sitas');
    }
}
