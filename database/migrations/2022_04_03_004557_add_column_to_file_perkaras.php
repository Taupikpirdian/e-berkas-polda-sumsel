<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToFilePerkaras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('file_perkaras', function (Blueprint $table) {
            $table->boolean('is_forward')->after('perkara_id')->default('1');
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
            $table->dropColumn('is_forward');
        });
    }
}
