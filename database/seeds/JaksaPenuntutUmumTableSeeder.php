<?php

use App\User;
use App\Akses;
use App\JaksaPenuntutUmum;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class JaksaPenuntutUmumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // inisialisasi
        $data = array(
            ['name' => 'Sudiono', 'nip' => '196110271988031003', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 2],
            ['name' => 'SITI FATIMAH, S.H., M.H.', 'nip' => '198202212006032001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 1],
            ['name' => 'KIAGUS ANWAR, S.H.', 'nip' => '198706122006041001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 3],
            ['name' => 'SUTANTI, S.H.', 'nip' => '198612102005012001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 4],
            ['name' => 'RINI PURNAMAWATI, S.H.', 'nip' => '197708032001122002', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 5],
            ['name' => 'NENNY KARMILA, S.H.', 'nip' => '197209162003122002', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 1],
            ['name' => 'MURNI, S.H.', 'nip' => '197401181999032003', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 5],
            ['name' => 'DESMILITA, S.H.', 'nip' => '198204172006032001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 1],
            ['name' => 'DEVIANTI ITERIA, S.H.', 'nip' => '197401011996032001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 1],
            ['name' => 'CIK MUHAMAD SYAHRUL, S.H.', 'nip' => '199202022018011002', 'no_tlp' => '085780980400', 'status' => 1, 'pangkat_id' => 6],
            ['name' => 'MOHD. REZA LAGAN', 'nip' => '199301282015021001', 'no_tlp' => '081258517512', 'status' => 1, 'pangkat_id' => 7],
            ['name' => 'RIDHO DHARMA HERMANDO, S.H., M.H.', 'nip' => '198212052003121004', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 8],
            ['name' => 'NADIA SEPTIFANNY, S.H', 'nip' => '199509282018012001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 4],
            ['name' => 'HETTY VERONICA MAGDALENA SIHOTANG, S.H', 'nip' => '198404172007122001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'ICHSAN AZWAR, S.H, M.H', 'nip' => '199204042018011004', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 4],
            ['name' => 'PALITO HAMONANGAN, S.H', 'nip' => '199112092015021001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 4],
            ['name' => 'JODHI ATMA ENCHI,SH.', 'nip' => '198801212009121001', 'no_tlp' => '082177776007', 'status' => 1, 'pangkat_id' => 3],
            ['name' => 'Elsanaz Nadea,SH.', 'nip' => '199310262018012003', 'no_tlp' => '081234737764', 'status' => 1, 'pangkat_id' => 4],
            ['name' => 'ZUBAIDI SH', 'nip' => '198007162002121003', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'AYU SORAYA PUTRI SH', 'nip' => '198808212010122001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 3],
            ['name' => 'MHD FALAKI, S.H.,M.H.', 'nip' => '197902152003121003', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'TRI AGUSTINA AMALIA, S.H.', 'nip' => '197808022000032001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'MISRIANTI, SH.,MH.', 'nip' => '198301202007032001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 1],
            ['name' => 'PARAMITHA, S.H., M.H', 'nip' => '199008202015022001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 3],
            ['name' => 'RIDO HARIAWAN PRABOWO, S.H.', 'nip' => '199007112015021001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 4],
            ['name' => 'YULIUS DASA SAPUTRA, S.H.', 'nip' => '198407192008121001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'IRWAN HADI, S.H', 'nip' => '196912181990031002', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 12],
            ['name' => 'JOKO SUDIRJO, S.H.', 'nip' => '197407142002121007', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 4],
            ['name' => 'EDDY SUGANDI TAHIR, S.H.', 'nip' => '198505092003121003', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'SIGIT SUBIANTORO, S.H.', 'nip' => '197902261999031001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 1],
            ['name' => 'HERY FADLULLAH, S.H.', 'nip' => '198405242007031001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'FITA FITRALLAH, S.H.', 'nip' => '198412082005012001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 3],
            ['name' => 'ABDULLAH, S.H.', 'nip' => '197706082002121003', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'ANDRIYANTO M B, S.H', 'nip' => '197908262002121003', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'RISKY KHAIRULLAH, S.H.', 'nip' => '199403062018011003', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 10],
            ['name' => 'Julindra Purnama Jaya, S.H', 'nip' => '198207172006041006', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 3],
            ['name' => 'Resita Rachmadani, S.H', 'nip' => '199502052018012001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 10],
            ['name' => 'DESTY PUSPITA SARI, S.H.', 'nip' => '198912052014032002', 'no_tlp' => '085265614433', 'status' => 1, 'pangkat_id' => 4],
            ['name' => 'MUNAWIR, S.H', 'nip' => '199108042015021001', 'no_tlp' => '082218518778', 'status' => 1, 'pangkat_id' => 4],
            ['name' => 'ARIANTI MAYA PUSPA DEWI, S.H', 'nip' => '198601162008122002', 'no_tlp' => '08117112686', 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'KRESNA,S.H.', 'nip' => '199404252018011001', 'no_tlp' => '081369725579', 'status' => 1, 'pangkat_id' => 10],
            ['name' => 'RENOFADLI RIZKISYAH,S.H.', 'nip' => '199405292018011001', 'no_tlp' => '082211299248', 'status' => 1, 'pangkat_id' => 10],
            ['name' => 'RIAN PRANA PUTRA,S.H.', 'nip' => '198905102014031002', 'no_tlp' => '081928283400', 'status' => 1, 'pangkat_id' => 4],
            ['name' => 'ARIO APRIYANTO GOPAR, S.H., M.H.', 'nip' => '198707252009121001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 3],
            ['name' => 'ABDULLAH TAUHID, S.H.', 'nip' => '198511112008121001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'FRANSISCA KARTINI SIAMBATON,S.H., M.H', 'nip' => '198504262008122004', 'no_tlp' => '081278452520', 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'IMRAN, S.H.', 'nip' => '199112312014031001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 4],
            ['name' => 'WULAN OCTASARI, S.H.', 'nip' => '199310152018012001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 10],
            ['name' => 'RONALD REGIANTO, SH.MH', 'nip' => '1989112892014031002', 'no_tlp' => '081279715887', 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'ANDRI SETIAWAN, S.H.', 'nip' => '199105212018011002', 'no_tlp' => '082184835883', 'status' => 1, 'pangkat_id' => 10],
            ['name' => 'DAVID SIANTURI, S.H', 'nip' => '198406252009121001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'SHANTY MERIANIE, SH', 'nip' => '198003062005012007', 'no_tlp' => '081377758222', 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'EFRAN, S.H', 'nip' => '198411182008121001', 'no_tlp' => null, 'status' => 1, 'pangkat_id' => 9],
            ['name' => 'TRIANDRE RIEZKA BAYU VALINTIN, S.H.', 'nip' => '198602142006041001', 'no_tlp' => '085381533333', 'status' => 1, 'pangkat_id' => 4],
        );

        echo "Seeder inisialiasi jaksa penuntut umum dimulai ... ";
        echo "\n";

        // truncate data table
        JaksaPenuntutUmum::truncate();

        foreach ($data as $data_jaksa) {
            $slugName = Str::slug($data_jaksa['name'], '-');
            $email = $slugName . '@cjs-sumsel.id';

            // create user
            $userKej = User::updateOrCreate(
                [
                    'email' =>  $email
                ],
                [
                    'name'  => $data_jaksa['name'],
                    'password'  => Hash::make('aaa123'),
                ]
            );
            $userKej->assignRole('kejaksaan');

            JaksaPenuntutUmum::create([
                'name' => $data_jaksa['name'],
                'nip' => $data_jaksa['nip'],
                'no_tlp' => $data_jaksa['no_tlp'],
                'status' => $data_jaksa['status'],
                'pangkat_id' => $data_jaksa['pangkat_id'],
                'user_id' => $userKej->id,
            ]);

            $check_user = User::where(['email' => $email])->first();
            if ($check_user) {
                $akses = new Akses();
                $akses->user_id = $check_user->id;
                $akses->kategori_bagian_id     = 13; // Kejaksaan Negeri Palembang
                $akses->save();
            }
        }

        echo "Seeder inisialiasi jaksa penuntut umum selesai ... ";
        echo "\n";
    }
}
