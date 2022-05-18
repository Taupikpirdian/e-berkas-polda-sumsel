<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileBonTahanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_bon_tahanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code_id')->nullable();
            $table->unsignedBigInteger('bon_tahanan_id');
            $table->string('original_name');
            $table->string('name');
            $table->string('type_file');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('file_bon_tahanans');
    }
}
