<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAlamatToBeritaAcaras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('berita_acaras', function (Blueprint $table) {
            $table->date('tanggal')->after('kategori_bagian_id');
            $table->text('surat_perintah')->after('kategori_bagian_id');
            $table->text('alamat')->after('kategori_bagian_id');
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
            $table->dropColumn('tanggal');
            $table->dropColumn('surat_perintah');
            $table->dropColumn('alamat');
        });
    }
}
