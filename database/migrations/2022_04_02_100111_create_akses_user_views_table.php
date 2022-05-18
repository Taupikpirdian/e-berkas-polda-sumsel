<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAksesUserViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW aksesuser_v 
        AS
        (
            SELECT 
                akses.id as id,
                kategori_bagians.id as kategoribagian_id,
                kategori_bagians.kategori_id as kategori_id,
                kategori_bagians.name as name_kategori_bagian,
                kategori_bagians.kode as kode,
                kategori_bagians.tipe_lembaga_id as tipelembaga_id,
                m_tipe_lembagas.name as namatipe_lembaga,
                users.id as user_id,
                users.email as email,
                users.name as user_name,
                akses.created_at as created_at
            FROM 
                akses 
                LEFT JOIN kategori_bagians ON akses.kategori_bagian_id = kategori_bagians.id
                LEFT JOIN users ON akses.user_id = users.id
                LEFT JOIN m_tipe_lembagas ON kategori_bagians.tipe_lembaga_id = m_tipe_lembagas.id
        )
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akses_user_views');
    }
}
