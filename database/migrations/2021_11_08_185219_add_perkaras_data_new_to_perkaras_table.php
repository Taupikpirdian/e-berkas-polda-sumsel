<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPerkarasDataNewToPerkarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perkaras', function (Blueprint $table) {
            $table->text('kronologi')->after('no_lp')->nullable();
            $table->string('penyidik')->after('kronologi')->nullable();
            $table->string('nrp')->after('penyidik')->nullable();
            $table->string('no_hp')->after('nrp')->nullable();
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
            $table->dropColumn('kronologi');
            $table->dropColumn('penyidik');
            $table->dropColumn('nrp');
            $table->dropColumn('no_hp');
        });
    }
}
