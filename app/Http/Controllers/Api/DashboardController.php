<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTraits;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ApiResponseTraits;
    use ApiTraits;

    public function dataDashboard(Request $request)
    {
        $user = $this->userFromTokenApi($request);
        if (!$user) {
            return $this->unauthorized();
        }

        try {

            $dashboard = null;
            if ($user->hasRole('kepolisian')) {
                $dashboard = $this->dataAsKepolisian();
            } elseif ($user->hasRole('kejaksaan')) {
                $dashboard = $this->dataAsKejaksaan();
            } elseif ($user->hasRole('pengadilan')) {
                $dashboard = $this->dataAsPengadilan();
            } elseif ($user->hasRole('lapas')) {

            }
            
            $message = "mendapatkan data dashboard";
            return $this->ok($message, $dashboard);
        } catch (\Exception $e) {
            return $this->badRequest("Error : " . $e);
        }
    }

    public function dataAsAdmin()
    {

    }

    public function dataAsKepolisian()
    {
        $menu_kejaksaan = array(
            "title" => "Kejaksaan Tinggi Sumatera Selatan",
            "image" => "/images/icon/icon-kejaksaan-lg.png",
            "data" => [
                array(
                    "icon" => "fa fa-balance-scale",
                    "title" => "SPDP",
                    "total" => "2 Data Pranut",
                    "button_name" => "Tambah",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-calendar-check-o",
                    "title" => "PERPANJANGAN PENAHANAN",
                    "total" => "0 Data",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-book",
                    "title" => "PENGIRIMAN BERKAS",
                    "total" => "2 Data Pranut",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-comment",
                    "title" => "DISKUSI PERKARA",
                    "total" => null,
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
            ],
        );

        $menu_pengadilan = array(
            "title" => "Pengadilan Negeri di Wilayah Sumatera Selatan",
            "image" => "/images/icon/icon-pengadilan.png",
            "data" => [
                array(
                    "icon" => "fa fa-bars",
                    "title" => "IZIN SITA",
                    "total" => "0 Data",
                    "button_name" => "Tambah",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-bars",
                    "title" => "IZIN GELEDAH",
                    "total" => "0 Data",
                    "button_name" => "Tambah",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-calendar-plus-o",
                    "title" => "PENETAPAN SITA GELEDAH",
                    "total" => "0 Data",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-table",
                    "title" => "PERPANJANGAN PENAHANAN",
                    "total" => "0 Data",
                    "button_name" => "Tambah",
                    "button_active" => false,
                ),
                array(
                    "icon" => "fa fa-bars",
                    "title" => "BACP TIPIRING",
                    "total" => "1 Data",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-bars",
                    "title" => "DIVERSI",
                    "total" => "1 Data",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-bars",
                    "title" => "PERSETUJUAN SP HAN",
                    "total" => "0 Data",
                    "button_name" => "Lihat",
                    "button_active" => false,
                ),
                array(
                    "icon" => "fa fa-globe",
                    "title" => "AMAR PUTUSAN",
                    "total" => null,
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-globe",
                    "title" => "JADWAL SIDANG",
                    "total" => null,
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
            ],
        );

        $menu_lapas = array(
            "title" => "Lapas Sumatera Selatan",
            "image" => "/images/icon/icon-kemenkumham-lg.png",
            "data" => [
                array(
                    "icon" => "fa fa-bars",
                    "title" => "RUMAH TAHANAN",
                    "total" => "16 Data",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-bars",
                    "title" => "LIST DATA TAHANAN",
                    "total" => "0 Data",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
            ],
        );

        $data_dashboard = [
            $menu_kejaksaan,
            $menu_pengadilan,
            $menu_lapas,
        ];

        return $data_dashboard;
    }

    public function dataAsKejaksaan()
    {
        $menu_kepolisian = array(
            "title" => "Kepolisian Sumatera Selatan",
            "image" => "/images/icon/icon.png",
            "data" => [
                array(
                    "icon" => "fa fa-balance-scale",
                    "title" => "LIST PENERIMAAN SPDP",
                    "total" => "0 Data",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-book",
                    "title" => "PENERIMAAN BERKAS PERKARA",
                    "total" => "0 Data Pranut",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-table",
                    "title" => "DATA P21",
                    "total" => "0 Data Pranut",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-book",
                    "title" => "TAHAP II",
                    "total" => null,
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-comment",
                    "title" => "KOLOM DISKUSI",
                    "total" => null,
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
            ],
        );

        $menu_pengadilan = array(
            "title" => "Pengadilan Negeri di Wilayah Sumatera Selatan",
            "image" => "/images/icon/icon-pengadilan.png",
            "data" => [
                array(
                    "icon" => "fa fa-paper-plane",
                    "title" => "PENGIRIMAN BERKAS PERKARA",
                    "total" => "0 Data",
                    "button_name" => "Kirim",
                    "button_active" => false,
                ),
                array(
                    "icon" => "fa fa-bars",
                    "title" => "LIST TANDA TERIMA BERKAS PERKARA",
                    "total" => "0 Data",
                    "button_name" => "Lihat",
                    "button_active" => false,
                ),
                array(
                    "icon" => "fa fa-bars",
                    "title" => "LIST PENUNJUKAN HAKIM",
                    "total" => "0 Data",
                    "button_name" => "Lihat",
                    "button_active" => false,
                ),
                array(
                    "icon" => "fa fa-globe",
                    "title" => "JADWAL SIDANG",
                    "total" => null,
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-globe",
                    "title" => "AMAR PUTUSAN",
                    "total" => null,
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
            ],
        );

        $menu_lapas = array(
            "title" => "Lapas Sumatera Selatan",
            "image" => "/images/icon/icon-kemenkumham-lg.png",
            "data" => [
                array(
                    "icon" => "fa fa-bars",
                    "title" => "RUMAH TAHANAN",
                    "total" => "16 Data",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-bars",
                    "title" => "LIST DATA TAHANAN",
                    "total" => "0 Data",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
            ],
        );

        $data_dashboard = [
            $menu_kepolisian,
            $menu_pengadilan,
            $menu_lapas,
        ];

        return $data_dashboard;
    }

    public function dataAsLapas()
    {

    }

    public function dataAsPengadilan()
    {
        $menu_kepolisian = array(
            "title" => "Kepolisian Sumatera Selatan",
            "image" => "/images/icon/icon.png",
            "data" => [
                array(
                    "icon" => "fa fa-bars",
                    "title" => "LIST IZIN SITA",
                    "total" => "0 Data",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-bars",
                    "title" => "LIST IZIN GELEDAH",
                    "total" => "0 Data",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-bars",
                    "title" => "LIST SP HAN",
                    "total" => "0 Data",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-comment",
                    "title" => "DISKUSI PERKARA",
                    "total" => null,
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
            ],
        );

        $menu_kejaksaan = array(
            "title" => "Kejaksaan Tinggi Sumatera Selatan",
            "image" => "/images/icon/icon-kejaksaan-lg.png",
            "data" => [
                array(
                    "icon" => "fa fa-balance-scale",
                    "title" => "LIST BERKAS PERKARA",
                    "total" => "0 Data",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-calendar-check-o",
                    "title" => "APPROVE BERKAS PERKARA",
                    "total" => "0 Data",
                    "button_name" => "Kirim",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-table",
                    "title" => "PENUNJUKAN HAKIM",
                    "total" => "0 Data",
                    "button_name" => "Kirim",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-globe",
                    "title" => "DISKUSI PERKARA",
                    "total" => null,
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
            ],
        );

        $menu_lapas = array(
            "title" => "Lapas Sumatera Selatan",
            "image" => "/images/icon/icon-kemenkumham-lg.png",
            "data" => [
                array(
                    "icon" => "fa fa-bars",
                    "title" => "RUMAH TAHANAN",
                    "total" => "16 Data",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
                array(
                    "icon" => "fa fa-bars",
                    "title" => "LIST DATA TAHANAN",
                    "total" => "0 Data",
                    "button_name" => "Lihat",
                    "button_active" => true,
                ),
            ],
        );

        $data_dashboard = [
            $menu_kepolisian,
            $menu_kejaksaan,
            $menu_lapas,
        ];

        return $data_dashboard;
    }
}
