<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusDeadlineUploadBerkasOnTablePerkaras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perkaras', function (Blueprint $table) {
            $table->integer('status_dead_line_upload_berkas')->default(0)->after('dead_line_upload_berkas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perkaras', function (Blueprint $table) {
            $table->dropColumn('status_dead_line_upload_berkas');
        });
    }
}
