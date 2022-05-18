<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class UpdateAssignPerkarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assign_perkaras', function ($table) {
            $table->string('catatan')->nullable();
            $table->boolean('is_assign_perkara')->default(false);
            $table->string('catatan_hasil_assign_perkara')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
