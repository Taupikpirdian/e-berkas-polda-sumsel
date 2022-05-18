<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangBuktiNarkotikaFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_bukti_narkotika_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code_id')->nullable();
            $table->unsignedBigInteger('barangbuktinarkotika_id');
            $table->string('original_name');
            $table->string('name');
            $table->string('type_file');
            $table->boolean('status')->default(0);
            $table->string('path');
            $table->string('catatan')->nullable();
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
        Schema::dropIfExists('barang_bukti_narkotika_files');
    }
}
