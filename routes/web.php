<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/clear-cache', function() {
//     Artisan::call('optimize');
// echo Artisan::output();
// });
Auth::routes(['register' => false]);

// welcome controller 
Route::get('/', 'WelcomeController@index');
// testing api wa
Route::get('/api-wa/send-message-whatsapp', 'WelcomeController@sendWa');
Route::get('/twilio/send-message-whatsapp', 'WelcomeController@sendWaTwilio');
Route::get('/403/tidak-memiliki-akses', 'WelcomeController@noHaveAkses')->name('403.no-have-akses');
Route::get('/403/tidak-memiliki-role', 'WelcomeController@noHaveRole')->name('403.no-have-role');

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return redirect('/dashboard');
});

Route::group(['middleware' => ['auth']], function () {
    // set pin
    Route::get('/set-pin', 'HomeController@setPin')->name('set-pin');
    Route::post('/set-pin', 'Auth\SetPinController@create')->name('post-set-pin');

    Route::middleware('role:admin-master|admin-kepolisian|admin-kejaksaan')->group(function () {
        // users
        Route::resource('users', 'Admin\UserController');
        Route::middleware('role:admin-master')->group(function () {
            // akses
            Route::resource('akses', 'Admin\AksesController');
            // role
            Route::resource('roles', 'Admin\RoleController');
            // permission
            Route::resource('permissions', 'Admin\PermissionController');
            // code file
            Route::resource('code-file', 'Admin\CodeFileController');
            // kategori bagian 
            Route::resource('kategori-bagian', 'Admin\KategoriBagianController');
            // instansi
            Route::resource('instansi', 'Admin\InstansiController');
            // jabatan
            Route::resource('jabatan', 'Admin\JabatanController');
            // pangkat
            Route::resource('pangkat', 'Admin\PangkatController');
            // pejabat
            Route::resource('pejabat', 'Admin\PejabatController');
            // pengadilan negeri
            Route::resource('pengadilan-negeri', 'Admin\PengadilanNegeriController');
            // lapas
            Route::resource('lapas', 'Admin\LapasController');
        });
    });

    Route::group(['middleware' => ['akses']], function () { // must have akses to satker
        Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
        Route::get('/profiles/ubah-password/{id}', 'ProfileController@changePw')->name('ubah-password');
        Route::get('/profiles/ubah-pin/{id}', 'ProfileController@changePin')->name('ubah-pin');
        Route::resource('profiles', 'ProfileController');
        Route::get('/download-file/{id}', 'Kepolisian\DataPranutController@download')->name('download-file');
        Route::get('/download-file-discussion/{id}', 'Kepolisian\DataPranutController@downloadOnDiscussion')->name('download-file-discussion');
        Route::get('/download-file-bacp-tipiring/{id}/{code}', 'BpacTipiringController@download')->name('download-file-bacp-tipiring');
        Route::get('/download-diversi/{id}', 'DiversiController@download')->name('download-diversi');
        Route::get('/download-file-izin-pengadilan/{id}', 'PengadilanController@download')->name('download-file-izin-sita');
        Route::get('/download-titipan-penahanan/{id}', 'Lapas\TitipanTahananController@download')->name('download-titipan-penahanan');
        Route::get('/download-data-penahanan/{id}', 'DataPenahananController@download')->name('download-data-penahanan');
        Route::get('/download-perpanjangan-penahanan/{id}', 'Kejaksaan\PerpanjanganPenahananController@download')->name('download-perpanjangan-penahanan');
        Route::get('/download-barang-bukti-narkotika/{id}', 'Kepolisian\BarangBuktiNarkotikaController@download')->name('download-perpanjangan-penahanan');

        Route::middleware('role:kepolisian|admin-kejaksaan|admin-kepolisian|kejaksaan|admin-master|operator-01|operator-02|operator-03|operator-04|operator-kasi-pidum|operator-kasi-pidsus')->group(function () {
            // list perkara 
            Route::resource('data-prapenuntutan', 'Kepolisian\DataPranutController');
            Route::resource('batas-waktu-upload', 'Kepolisian\BatasWaktuUploadController');
            Route::resource('data-prapenuntutan-lengkap', 'Kepolisian\DataPranutLengkapController');
            Route::post('laporan-perkara/create-jaksa', 'Kepolisian\DataPranutController@assignJaksa')->name('create-jaksa');
            Route::post('laporan-perkara/edit-jaksa', 'Kepolisian\DataPranutController@editJaksa')->name('edit-jaksa');
            Route::post('laporan-perkara/uploadBerkasLanjutan', 'Kepolisian\DataPranutController@uploadBerkasLanjutan')->name('upload-berkas-lanjutan');

            Route::middleware('role:kepolisian')->group(function () {
                // Split tersangka
                Route::get('split-tersangka/{id}', 'Kepolisian\DataPranutController@splitTersangka');
                // hentikan perkara
                Route::post('hentikan-perkara', 'Kepolisian\DataPranutController@hentikanPerkara')->name('hentikan-perkara');
            });
            // barang bukti narkotika 
            Route::resource('barang-bukti-narkotika', 'Kepolisian\BarangBuktiNarkotikaController');
            Route::post('barang-bukti-narkotika/create', 'Kepolisian\BarangBuktiNarkotikaController@createBalasan')->name('store-data-bukti-narkotika');
            // Perpanjangan Penahanan 
            Route::resource('perpanjangan-penahanan', 'Kejaksaan\PerpanjanganPenahananController');
            // Bacp Tipiring
            Route::resource('bacp-tipiring', 'BpacTipiringController');
            //  limpah perkara
            Route::middleware('role:kejaksaan|admin-kejaksaan')->group(function () {
                Route::resource('data-prapenuntutan-limpah', 'Kejaksaan\DataPranutLimpahController');
                Route::post('data-prapenuntutan-limpah/assign-pengadilan', 'Kejaksaan\DataPranutLimpahController@assignPengadilan')->name('limpah-assign-pengadilan');
                Route::post('data-prapenuntutan-limpah/upload-file', 'Kejaksaan\DataPranutLimpahController@uploadFile')->name('upload-file-limpah');
                Route::get('data-prapenuntutan-limpah/forward/{id}/{fitur}', 'Kejaksaan\DataPranutLimpahController@forward')->name('forward-pengadilan');
                Route::post('data-prapenuntutan-limpah/updateForwardPengadilan', 'Kejaksaan\DataPranutLimpahController@updateForwardPengadilan')->name('forward-pengadilan');
            });

            Route::middleware('role:admin-kepolisian')->group(function () {
                Route::post('data-pranut/update-penyidik-by-perkara', 'Kepolisian\DataPranutController@updatePenyidikByPerkara')->name('update-penyidik-by-perkara'); 
            });
        });

        Route::middleware('role:admin-master|admin-kejaksaan')->group(function () {
            // kejaksaan negeri
            Route::resource('kejaksaan-negeri', 'Admin\KejaksaanNegeriController');
            // jaksa penuntut umum
            Route::resource('jaksa-penuntut-umum', 'Admin\JaksaPenuntutUmumController');
            // Bacp Tipiring
            Route::resource('bacp-tipiring', 'BpacTipiringController');
            // limpah perkara
            Route::middleware('role:admin-kejaksaan')->group(function () {
                Route::resource('data-prapenuntutan-limpah', 'Kejaksaan\DataPranutLimpahController');
                Route::get('data-prapenuntutan-limpah/forward/{id}/{fitur}', 'Kejaksaan\DataPranutLimpahController@forward')->name('forward-pengadilan');
            });
        });

        Route::middleware('role:kepolisian')->group(function () {
            Route::post('data-pranut/store-berkas', 'Kepolisian\DataPranutController@storeBerkas')->name('store-berkas');
            Route::post('data-pranut/store-tahap-2', 'Kepolisian\DataPranutController@storeTahap2')->name('store-tahap-2');
        });

        Route::middleware('role:kejaksaan|operator-01|operator-02|operator-03|operator-04|operator-kasi-pidum|operator-kasi-pidsus')->group(function () {
            // list data polri 
            Route::resource('list-perkara-kepolisian', 'Kejaksaan\ListPolresController');
            Route::post('laporan-perkara/create-file', 'Kepolisian\DataPranutController@addFileJaksa')->name('create-file');
            Route::post('data-pranut/store-p17', 'Kepolisian\DataPranutController@storeP17')->name('store-p17');
            Route::post('data-pranut/store-p18', 'Kepolisian\DataPranutController@storeP18')->name('store-p18');
            Route::post('data-pranut/store-p19', 'Kepolisian\DataPranutController@storeP19')->name('store-p19');
            Route::post('data-pranut/store-p20', 'Kepolisian\DataPranutController@storeP20')->name('store-p20');
            Route::post('data-pranut/store-p21', 'Kepolisian\DataPranutController@storeP21')->name('store-p21');
            Route::post('data-pranut/store-p21a', 'Kepolisian\DataPranutController@storeP21A')->name('store-p21a');
            Route::post('data-pranut/store-sop-02', 'Kepolisian\DataPranutController@storeSop02')->name('store-sop-02');
            Route::post('data-pranut/store-berkas-kembali', 'Kepolisian\DataPranutController@storeBerkasKembali')->name('store-berkas-kembali');
            // berita acara 
            Route::resource('berita-acara', 'Kejaksaan\BeritaAcaraController');

            //  limpah perkara
            Route::middleware('role:kejaksaan')->group(function () {
                Route::resource('data-prapenuntutan-limpah', 'Kejaksaan\DataPranutLimpahController');
                Route::post('data-prapenuntutan-limpah/assign-pengadilan', 'Kejaksaan\DataPranutLimpahController@assignPengadilan')->name('limpah-assign-pengadilan');
                Route::post('data-prapenuntutan-limpah/upload-file', 'Kejaksaan\DataPranutLimpahController@uploadFile')->name('upload-file-limpah');
                Route::get('data-prapenuntutan-limpah/forward/{id}/{fitur}', 'Kejaksaan\DataPranutLimpahController@forward')->name('forward-pengadilan');
                Route::post('data-prapenuntutan-limpah/updateForwardPengadilan', 'Kejaksaan\DataPranutLimpahController@updateForwardPengadilan')->name('forward-pengadilan');
            });
        });

        Route::middleware('role:kepolisian|kejaksaan|pengadilan')->group(function () {
            // diskusi
            Route::resource('discussion', 'DiskusiController');
            // Diversi 
            Route::resource('diversi', 'DiversiController');
            Route::post('diversi/store-diversi', 'DiversiController@createBalasan')->name('store-diversi');
            // Izin Sita Geledah
            Route::post('izin-pengadilan/store-pengajual-izin-sita', 'PengadilanController@storePengajuanIzinSita')->name('store-pengajual-izin-sita');
            Route::post('izin-pengadilan/store-balasan-izin-sita', 'PengadilanController@storeBalasanIzinSita')->name('store-balasan-izin-sita');
            Route::resource('izin-pengadilan', 'PengadilanController');
            // bacp tipiring
            Route::resource('bacp-tipiring', 'BpacTipiringController');
            Route::post('bacp-tipiring/store-file-bacp-tipiring', 'BpacTipiringController@createBalasan')->name('store-file-bacp-tipiring');
            Route::resource('perpanjangan-penahanan', 'Kejaksaan\PerpanjanganPenahananController');

            //  limpah perkara
            Route::middleware('role:kejaksaan|pengadilan')->group(function () {
                Route::resource('data-prapenuntutan-limpah', 'Kejaksaan\DataPranutLimpahController');
                Route::post('data-prapenuntutan-limpah/assign-pengadilan', 'Kejaksaan\DataPranutLimpahController@assignPengadilan')->name('limpah-assign-pengadilan');
                Route::post('data-prapenuntutan-limpah/upload-file', 'Kejaksaan\DataPranutLimpahController@uploadFile')->name('upload-file-limpah');
                Route::get('data-prapenuntutan-limpah/forward/{id}/{fitur}', 'Kejaksaan\DataPranutLimpahController@forward')->name('forward-pengadilan');
                Route::post('data-prapenuntutan-limpah/updateForwardPengadilan', 'Kejaksaan\DataPranutLimpahController@updateForwardPengadilan')->name('forward-pengadilan');
            });
        });

        Route::middleware('role:kepolisian|pengadilan|lapas|kejaksaan')->group(function () {
            // data penahanan
            Route::resource('data-penahanan', 'DataPenahananController');
            Route::post('data-penahanan/store-data-penahanan', 'DataPenahananController@createBalasan')->name('store-data-penahanan');
            // bon tahanan
            Route::resource('bon-tahanan', 'BonTahananController');

            //  limpah perkara
            Route::middleware('role:kejaksaan|pengadilan')->group(function () {
                Route::resource('data-prapenuntutan-limpah', 'Kejaksaan\DataPranutLimpahController');
                Route::post('data-prapenuntutan-limpah/assign-pengadilan', 'Kejaksaan\DataPranutLimpahController@assignPengadilan')->name('limpah-assign-pengadilan');
                Route::post('data-prapenuntutan-limpah/upload-file', 'Kejaksaan\DataPranutLimpahController@uploadFile')->name('upload-file-limpah');
                Route::get('data-prapenuntutan-limpah/forward/{id}/{fitur}', 'Kejaksaan\DataPranutLimpahController@forward')->name('forward-pengadilan');
                Route::post('data-prapenuntutan-limpah/updateForwardPengadilan', 'Kejaksaan\DataPranutLimpahController@updateForwardPengadilan')->name('forward-pengadilan');
            });
        });

        Route::middleware('role:lapas|admin-lapas|admin-kejaksaan|kepolisian|kejaksaan|pengadilan')->group(function () {
            // rumah tahanan
            Route::resource('rumah-tahanan', 'Lapas\RumahTahananController');
            Route::resource('tahanan', 'Lapas\TahananController');
            Route::resource('napi-bebas', 'Lapas\NapiBebasController');
            // titipan tahanan
            Route::resource('titipan-tahanan', 'Lapas\TitipanTahananController');
            Route::post('titipan-tahanan/store-titipan-tahanan', 'Lapas\TitipanTahananController@createBalasan')->name('store-titipan-tahanan');
            // Bacp Tipiring
            Route::resource('bacp-tipiring', 'BpacTipiringController');

            //  limpah perkara
            Route::middleware('role:kejaksaan|pengadilan|admin-kejaksaan')->group(function () {
                Route::resource('data-prapenuntutan-limpah', 'Kejaksaan\DataPranutLimpahController');
                Route::post('data-prapenuntutan-limpah/assign-pengadilan', 'Kejaksaan\DataPranutLimpahController@assignPengadilan')->name('limpah-assign-pengadilan');
                Route::post('data-prapenuntutan-limpah/upload-file', 'Kejaksaan\DataPranutLimpahController@uploadFile')->name('upload-file-limpah');
                Route::get('data-prapenuntutan-limpah/forward/{id}/{fitur}', 'Kejaksaan\DataPranutLimpahController@forward')->name('forward-pengadilan');
                Route::post('data-prapenuntutan-limpah/updateForwardPengadilan', 'Kejaksaan\DataPranutLimpahController@updateForwardPengadilan')->name('forward-pengadilan');
            });
        });

        Route::middleware('role:lapas|admin-lapas')->group(function () {
            Route::post('lapas/import-rumah-tahanan', 'Lapas\RumahTahananController@import')->name('import-rumah-tahanan');
            Route::post('import-tahanan', 'Lapas\TahananController@import')->name('import-tahanan');
            Route::post('lapas/napi-bebas', 'Lapas\NapiBebasController@import')->name('napi-bebas');
        });
    });
    // notification ajax page dashboard
    Route::get('/notification/count', 'NotificationController@countNotif');
    Route::get('/notification/list-data', 'NotificationController@listNotif');
    Route::get('/notification/list-data-for-toastr', 'NotificationController@listNotifForToastr');
    Route::get('/notification/list-data-view', 'NotificationController@listDataView');
    Route::get('/notification/validate-pin/{id}/{pin}/{notif_type}', 'NotificationController@validatePin');
    Route::get('/called/helper-encrpt/{id}', 'NotificationController@callHelperEncryp');

    Route::get('/export/users', 'Admin\UserController@exportUser');
});
