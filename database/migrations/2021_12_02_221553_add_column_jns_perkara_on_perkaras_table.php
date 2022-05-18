<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnJnsPerkaraOnPerkarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perkaras', function (Blueprint $table) {
            $table->integer('jns_pidana_id')->after('no_lp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perkaras', function (Blueprint $table) {
            $table->dropColumn('jns_pidana_id');
        });
    }
}
