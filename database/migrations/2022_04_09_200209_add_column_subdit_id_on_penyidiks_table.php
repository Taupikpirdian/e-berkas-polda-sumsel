<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSubditIdOnPenyidiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penyidiks', function (Blueprint $table) {
            $table->unsignedBigInteger('subdit_id')->after('pangkat_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penyidiks', function (Blueprint $table) {
            $table->dropColumn('subdit_id');
        });
    }
}
