<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKategoriBagianIdOnTahanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tahanans', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_id')->after('name')->nullable();
            $table->unsignedBigInteger('kategori_bagian_id')->after('kategori_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tahanans', function (Blueprint $table) {
            $table->dropColumn('kategori_id');
            $table->dropColumn('kategori_bagian_id');
        });
    }
}
