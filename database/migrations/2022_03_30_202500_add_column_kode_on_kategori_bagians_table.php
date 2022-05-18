<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKodeOnKategoriBagiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kategori_bagians', function (Blueprint $table) {
            $table->string('kode')->after('id')->nullable();
            $table->unsignedBigInteger('province_id')->after('no_tlp')->nullable();
            $table->unsignedBigInteger('city_id')->after('province_id')->nullable();
            $table->unsignedBigInteger('district_id')->after('city_id')->nullable();
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
            $table->dropColumn('kode');
            $table->dropColumn('province_id');
            $table->dropColumn('city_id');
            $table->dropColumn('district_id');
        });
    }
}
