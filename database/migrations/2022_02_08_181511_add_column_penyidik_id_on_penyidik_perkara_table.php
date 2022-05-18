<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPenyidikIdOnPenyidikPerkaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penyidik_perkaras', function (Blueprint $table) {
            $table->unsignedBigInteger('penyidik_id')->after('id');
            $table->dropColumn('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penyidik_perkaras', function (Blueprint $table) {
            $table->dropColumn('penyidik_id');
            $table->unsignedBigInteger('user_id')->after('id');
        });
    }
}
