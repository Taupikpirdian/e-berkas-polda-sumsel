<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePerpanjanganPenahananViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW perpanjanganpenahanan_v 
        AS
        (
            SELECT 
                assign_data_penahanans.id as id,
                assign_data_penahanans.name as name_assign,
                data_penahanans.id as datapenahanan_id,
                tersangka_penahanans.name as name_tersangka,
                users.id as user_id,
                perkaras.id as perkara_id,
                perkaras.no_lp as no_lp,
                perkaras.date_no_lp as tanggal_lp,
                data_penahanans.created_by as created_by,
                assign_data_penahanans.created_at as created_at
            FROM 
                assign_data_penahanans 
                LEFT JOIN data_penahanans ON assign_data_penahanans.datapenahanan_id = data_penahanans.id
                LEFT JOIN tersangka_penahanans ON data_penahanans.id = tersangka_penahanans.datapenahanan_id
                LEFT JOIN perkaras ON data_penahanans.perkara_id = perkaras.id
                LEFT JOIN jaksa_penuntut_umums ON assign_data_penahanans.akses_id = jaksa_penuntut_umums.id
                LEFT JOIN users ON jaksa_penuntut_umums.user_id = users.id
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
        Schema::dropIfExists('perpanjangan_penahanan_views');
    }
}
