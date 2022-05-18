<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToBeritaAcaras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('berita_acaras', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_bagian_id')->after('perkara_id');
            $table->unsignedBigInteger('kategori_id')->after('perkara_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('berita_acaras', function (Blueprint $table) {
            $table->dropColumn('kategori_bagian_id');
            $table->dropColumn('kategori_id');
        });
    }
}
