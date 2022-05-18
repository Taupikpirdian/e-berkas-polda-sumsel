<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTipeLembagaIdOnKategoriBagiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kategori_bagians', function (Blueprint $table) {
            $table->unsignedBigInteger('tipe_lembaga_id')->after('wilayah_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kategori_bagians', function (Blueprint $table) {
            $table->dropColumn('tipe_lembaga_id');
        });
    }
}
