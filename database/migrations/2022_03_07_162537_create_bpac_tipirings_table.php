<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBpacTipiringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bpac_tipirings', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pelimpahan');
            $table->date('tanggal_register');
            $table->string('tersangka');
            $table->unsignedBigInteger('penyidik_id')->nullable();
            $table->string('original_name');
            $table->string('name');
            $table->string('type_file');
            $table->string('path')->nullable();
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
        Schema::dropIfExists('bpac_tipirings');
    }
}
