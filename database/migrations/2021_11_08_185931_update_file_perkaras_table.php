<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFilePerkarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('file_perkaras', function ($table) {
            $table->string('catatan')->nullable();
        });
        
        Schema::table('assign_perkaras', function ($table) {
            $table->dropColumn('is_assign_perkara');
            $table->dropColumn('catatan_hasil_assign_perkara');
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
