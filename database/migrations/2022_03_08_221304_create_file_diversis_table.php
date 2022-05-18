<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileDiversisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_diversis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diversi_id');
            $table->string('code');
            $table->string('original_name');
            $table->string('name');
            $table->string('type_file');
            $table->string('path');
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
        Schema::dropIfExists('file_diversis');
    }
}
