<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnJaksaPenuntutUmumIdOnAssignPerkarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assign_perkaras', function (Blueprint $table) {
            $table->unsignedBigInteger('jaksa_penuntut_umum_id')->after('id');
            $table->dropColumn('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assign_perkaras', function (Blueprint $table) {
            $table->dropColumn('jaksa_penuntut_umum_id');
            $table->unsignedBigInteger('user_id')->after('id');
        });
    }
}
