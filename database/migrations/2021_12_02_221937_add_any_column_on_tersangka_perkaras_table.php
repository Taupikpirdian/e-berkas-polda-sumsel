<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnyColumnOnTersangkaPerkarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tersangka_perkaras', function (Blueprint $table) {
            $table->string('tempat_lahir')->after('name')->nullable();
            $table->date('tgl_lahir')->after('tempat_lahir')->nullable();
            $table->string('jk')->after('tgl_lahir')->nullable();
            $table->string('kebangsaan')->after('jk')->nullable();
            $table->string('alamat')->after('kebangsaan')->nullable();
            $table->string('agama')->after('alamat')->nullable();
            $table->string('pekerjaan')->after('agama')->nullable();
            $table->string('pendidikan')->after('pekerjaan')->nullable();
            $table->string('pasal')->after('pendidikan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tersangka_perkaras', function (Blueprint $table) {
            $table->dropColumn('tempat_lahir');
            $table->dropColumn('tgl_lahir');
            $table->dropColumn('jk');
            $table->dropColumn('kebangsaan');
            $table->dropColumn('alamat');
            $table->dropColumn('agama');
            $table->dropColumn('pekerjaan');
            $table->dropColumn('pendidikan');
            $table->dropColumn('pasal');
        });
    }
}
