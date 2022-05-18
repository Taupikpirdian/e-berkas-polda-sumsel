<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTersangkaPerkaraIdOnFilePerkarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('file_perkaras', function (Blueprint $table) {
            $table->unsignedBigInteger('tersangka_perkara_id')->after('perkara_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('file_perkaras', function (Blueprint $table) {
            $table->dropColumn('tersangka_perkara_id');
        });
    }
}
