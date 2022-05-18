<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerpanjanganPenahananFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perpanjangan_penahanan_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code_id')->nullable();
            $table->unsignedBigInteger('perpanjanganpenahanan_id');
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
        Schema::dropIfExists('perpanjangan_penahanan_files');
    }
}
