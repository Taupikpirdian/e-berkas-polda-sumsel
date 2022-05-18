<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePengadilanNegerisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pengadilan_negeris');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('pengadilan_negeris', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('wilayah_hukum');
            $table->timestamps();
        });
    }
}
