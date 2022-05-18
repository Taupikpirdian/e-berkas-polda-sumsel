<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDeadlineUploadBerkasOnTablePerkaras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perkaras', function (Blueprint $table) {
            $table->timestamp('dead_line_upload_berkas')->after('status')->nullable();
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
            $table->dropColumn('dead_line_upload_berkas');
        });
    }
}
