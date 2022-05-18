<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangBuktiNarkotikasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_bukti_narkotikas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kejaksaan_id');
            $table->unsignedBigInteger('perkara_id');
            $table->string('nosurat_permohonan');
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
        Schema::dropIfExists('barang_bukti_narkotikas');
    }
}
