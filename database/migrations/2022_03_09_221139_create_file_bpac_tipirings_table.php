<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileBpacTipiringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_bpac_tipirings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bpac_tipiring_id');
            $table->tinyInteger('code')->comment('1=pengaju; 2=balasan');
            $table->string('original_name');
            $table->string('name');
            $table->string('type_file');
            $table->string('path');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::table('bpac_tipirings', function($table) {
            $table->dropColumn('original_name');
            $table->dropColumn('name');
            $table->dropColumn('type_file');
            $table->dropColumn('path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_bpac_tipirings');
    }
}
