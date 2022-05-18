<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileIzinPengadilansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_izin_pengadilans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('izin_pengadilan_id');
            $table->string('jns_file')->comment('submission or feedback');
            $table->string('original_name');
            $table->string('name');
            $table->string('type_file');
            $table->string('path');
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
        Schema::dropIfExists('file_izin_pengadilans');
    }
}
