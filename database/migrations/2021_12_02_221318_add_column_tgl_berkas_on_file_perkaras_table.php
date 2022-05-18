<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTglBerkasOnFilePerkarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('file_perkaras', function (Blueprint $table) {
            $table->date('tgl_berkas')->after('no_berkas')->nullable();
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
            $table->dropColumn('tgl_berkas');
        });
    }
}
