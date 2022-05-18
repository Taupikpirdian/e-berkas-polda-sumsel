<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTableFileIzinGeledahs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('file_izin_geledahs');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('file_izin_geledahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code_id');
            $table->unsignedBigInteger('izin_geledah_id');
            $table->string('original_name');
            $table->string('name');
            $table->string('type_file');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }
}
