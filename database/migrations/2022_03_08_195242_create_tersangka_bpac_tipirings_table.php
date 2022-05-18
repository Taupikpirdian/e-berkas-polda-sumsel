<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTersangkaBpacTipiringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tersangka_bpac_tipirings', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->unsignedBigInteger('id_bpac_tipiring')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::table('bpac_tipirings', function($table) {
            $table->dropColumn('tersangka');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tersangka_bpac_tipirings');
    }
}
