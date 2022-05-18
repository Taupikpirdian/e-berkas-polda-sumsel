<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNikOnTersangkaPerkarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tersangka_perkaras', function (Blueprint $table) {
            $table->string('nik')->after('perkara_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tersangka_perkaras', function (Blueprint $table) {
            $table->dropColumn('nik');
        });
    }
}
