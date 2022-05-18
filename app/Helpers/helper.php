<?php

use App\AksesUserView;
use App\User;
use App\Akses;
use App\Constant;
use App\Http\Repositories\TersangkaRepository;
use App\Penyidik;
use Carbon\Carbon;
use App\Notification;
use App\KategoriBagian;
use App\JaksaPenuntutUmum;
use App\WilayahHukum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

function customTanggal($date, $date_from, $date_to)
{
    return \Carbon\Carbon::createFromFormat($date_from, $date)->format($date_to);
}

function checkPin($pinReq, $pinDb)
{
    return Hash::check($pinReq, $pinDb);
}

function helperEncrypt($data)
{
    return Crypt::encrypt($data);
}

function helperDecrypt($data)
{
    return Crypt::decrypt($data);
}

function thisUser()
{
    $user = Auth::user();
    return $user ? $user : 'null';
}

function userById($user_id)
{
    $user = User::where('id', $user_id)->first();
    return $user ? $user->name : '';
}

function thisRole()
{
    $user = Auth::user();
    return $user->roles->pluck('name')->isEmpty() ? 'null' : $user->roles->pluck('name')[0];
}

function dateIndo($date, $is_time = false, $with_day = true)
{
    $array_day_indo = [
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu',
    ];

    $array_month_indo = [
        'Jan' => 'Januari',
        'Feb' => 'Februari',
        'Mar' => 'Maret',
        'Apr' => 'April',
        'May' => 'Mei',
        'Jun' => 'Juni',
        'Jul' => 'Juli',
        'Aug' => 'Agustus',
        'Sep' => 'September',
        'Oct' => 'Oktober',
        'Nov' => 'November',
        'Dec' => 'Desember',
    ];

    // first parse the date data as Carbon object.
    $timestamp = strtotime($date);
    $day_sort_english = date('D', $timestamp);
    $month_sort_english = date('M', $timestamp);
    $day = $array_day_indo[$day_sort_english];
    $month = $array_month_indo[$month_sort_english];
    $year = date('Y', $timestamp);
    $tgl = date('d', $timestamp);

    if ($is_time == true) {
        $jam = date('H', $timestamp);
        $menit = date('i', $timestamp);
        if ($with_day == true) {
            $date = $day . ', ' . $tgl . ' ' . $month . ' ' . $year . ', ' . $jam . ':' . $menit;
        } else {
            $date = $tgl . ' ' . $month . ' ' . $year . ', ' . $jam . ':' . $menit;
        }
    } else {
        if ($with_day == true) {
            $date = $day . ', ' . $tgl . ' ' . $month . ' ' . $year;
        } else {
            $date = $tgl . ' ' . $month . ' ' . $year;
        }
    }

    return $date;
}

function dateTimeIndo($date)
{
    $array_day_indo = [
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu',
    ];

    $array_month_indo = [
        'Jan' => 'Januari',
        'Feb' => 'Februari',
        'Mar' => 'Maret',
        'Apr' => 'April',
        'May' => 'Mei',
        'Jun' => 'Juni',
        'Jul' => 'Juli',
        'Aug' => 'Agustus',
        'Sep' => 'September',
        'Oct' => 'Oktober',
        'Nov' => 'November',
        'Dec' => 'Desember',
    ];

    // first parse the date data as Carbon object.
    $timestamp = strtotime($date);
    $day_sort_english = date('D', $timestamp);
    $month_sort_english = date('M', $timestamp);
    $day = $array_day_indo[$day_sort_english];
    $month = $array_month_indo[$month_sort_english];
    $year = date('Y', $timestamp);
    $tgl = date('d', $timestamp);
    $time = date('H:i:s', $timestamp);

    $date = $day . ', ' . $tgl . ' ' . $month . ' ' . $year . ' ' . $time;
    return $date;
}

function notificationOne($req)
{
    $data = false;
    $user_id = $req['user_id'];
    $notif_for = $req['notif_for'];
    $notif_fitur = $req['notif_fitur'];
    $desc = $req['desc'];
    $data_id = $req['data_id'];
    $notif_type = $req['notif_type'];

    DB::beginTransaction();
    try {
        $notif = new Notification();
        $notif->user_id = $user_id; // pengirim
        $notif->notif_for = $notif_for; // penerima
        $notif->desc = $desc;
        $notif->data_id = $data_id;
        $notif->notif_type = $notif_type;
        $notif->notif_fitur = $notif_fitur;
        $notif->save();

        DB::commit();
        $data = true;
    } catch (\Throwable $th) {
        DB::rollback();
        dd($th);
    }

    return $data;
}

function notificationMany($req, $role, $fitur)
{
    $data = false;
    $user_id = $req['user_id'];
    $desc = $req['desc'];
    $data_id = $req['data_id'];
    $notif_type = $req['notif_type'];

    if ($role == 'admin-kejaksaan') {
        $arrKategoriBagianId = wilayahHukumRelasi();
        $users = User::whereHas('aksesFirst', function ($q) use ($arrKategoriBagianId) {
            $q->where('kategori_bagian_id', $arrKategoriBagianId);
        })->where('id', '!=', $user_id)->role('admin-kejaksaan')->get();
    } else {
        $users = User::role($role)->where('id', '!=', $user_id)->get();
    }

    // user with role
    // list user with kategori bagian id
    // $akses = Akses::with('user')->where('user_id', $user_id)->first();
    // $users = User::whereHas('akses', function ($q) use ($akses) {
    //     $q->where('kategori_bagian_id', $akses->kategori_bagian_id);
    // })->get();

    DB::beginTransaction();
    try {
        foreach ($users as $user) {
            $notif = new Notification();
            $notif->user_id = $user_id; // pengirim
            $notif->notif_for = $user->id; // penerima
            $notif->desc = $desc;
            $notif->data_id = $data_id;
            $notif->notif_type = $notif_type;
            $notif->notif_fitur = $fitur;
            $notif->save();
        }
        DB::commit();
        $data = true;
    } catch (\Throwable $th) {
        DB::rollback();
        dd($th);
    }

    return $data;
}

function userPengadilanByKategoriBagianId($kategori_bagian_id)
{
    $akses = Akses::with('user')->where('kategori_bagian_id', $kategori_bagian_id)->orderBy('created_at', 'desc')->first();
    $user = User::find($akses->user_id);
    return $user ? $user->id : null;
}

function thisKategoriBagian()
{
    $user = thisUser();
    $user_kategori_bagian = AksesUserView::where('user_id', $user->id)->first();
    return $user_kategori_bagian;
}

function thisAkses()
{
    $user = Auth::user();
    $akses = Akses::with(['satker'])->where('user_id', $user->id)->get();
    return $akses ? $akses : '';
}

function thisAksesFirst()
{
    $user = Auth::user();
    $akses = Akses::with(['satker'])->where('user_id', $user->id)->first();
    return $akses ? $akses : '';
}

function findTypeLembagaByAkses()
{
    $user = Auth::user();
    $akses = Akses::with(['satker'])->where('user_id', $user->id)->first();
    if ($akses) {
        return $akses->satker ? $akses->satker->tipe_lembaga_id : '';
    }
    return false;
}

function findKodeSatker()
{
    $user = Auth::user();
    $akses = Akses::with(['satker'])->where('user_id', $user->id)->first();
    if ($akses) {
        return $akses->satker ? $akses->satker->kode : '';
    }
    return false;
}

function haveAkses()
{
    return thisAkses()->isEmpty() ? false : true;
}

function wilayahHukumRelasi()
{
    $aksesKodeInduk = thisAksesFirst();
    $kodeInduk = $aksesKodeInduk->satker->kode;

    $kodeRelasi = WilayahHukum::with(['kategoriBagianRelasi'])->where('kode_induk', $kodeInduk)->first();
    return $kodeRelasi->kategoriBagianRelasi ? $kodeRelasi->kategoriBagianRelasi->id : null;
}

function wilayahHukumInduk()
{
    $arrId = [];
    $aksesKodeInduk = thisAksesFirst();
    $kodeRelasi = $aksesKodeInduk->satker->kode;

    $kodeinduks = WilayahHukum::with(['kategoriBagianInduk'])->where('kode_relasi', $kodeRelasi)->get();
    foreach ($kodeinduks as $ki) {
        $arrId[] = $ki->kategoriBagianInduk->id;
    }
    return $arrId;
}

function kategoriBagian()
{
    $user = Auth::user();
    $akses = Akses::where('user_id', $user->id)->first();
    $kategoriBagian = KategoriBagian::where('id', $akses->kategori_bagian_id)->first();

    return [
        'id' => $kategoriBagian ? $kategoriBagian->id : null,
        'name' => $kategoriBagian ? $kategoriBagian->name : null,
        'kategori_id' => $kategoriBagian ? $kategoriBagian->kategori_id : null,
    ];
}

function penyidikById($user_id)
{
    $penyidik = Penyidik::where('user_id', $user_id)->first();
    return $penyidik;
}

function jaksaById($user_id)
{
    $jpu = JaksaPenuntutUmum::where('user_id', $user_id)->first();
    return $jpu;
}

function penyidik()
{
    $user = Auth::user();
    $penyidik = Penyidik::where('user_id', $user->id)->first();

    return $penyidik ? $penyidik->name : '';
}

function jpu()
{
    $user = Auth::user();
    $jpu = JaksaPenuntutUmum::where('user_id', $user->id)->first();

    return $jpu ? $jpu->name : '';
}

function arrayPengadilanByAkses()
{
    $user = Auth::user();
    $arrayPengadilan = Akses::where('user_id', $user->id)->pluck('kategori_bagian_id')->toArray();

    return $arrayPengadilan;
}

function getListBulanChart($data_chart)
{
    $array_month_indo = [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'Mei',
        'Jun',
        'Jul',
        'Agu',
        'Sep',
        'Okt',
        'Nov',
        'Des'
    ];

    $result = array();
    foreach ($data_chart as $key => $value) {
        $index = $value['bulan'] - 1;
        array_push($result, $array_month_indo[$index]);
    }
    return $result;
}

function getListChart($data_chart, $nama_column)
{
    $result = array();
    foreach ($data_chart as $key => $value) {
        array_push($result, $value[$nama_column]);
    }
    return $result;
}

function transRoleOperator()
{
    return [
        'admin-master' => 'Admin Master',
        'admin' => 'Admin',
        'kepolisian' => 'Kepolisian',
        'admin-kepolisian' => 'Admin Kepolisian',
        'admin-kejaksaan' => 'Admin Kejaksaan',
        'kejaksaan' => 'Kejaksaan',
        'pengadilan' => 'Pengadilan',
        'admin-lapas' => 'Admin Lapas',
        'lapas' => 'Lapas',
        'operator-01' => 'Operator Oharda',
        'operator-02' => 'Operator Kamneg/Tibum/TPUL',
        'operator-03' => 'Operator Narkotika',
        'operator-04' => 'Operator Terorisme dan TPPU',
        'operator-kasi-pidum' => 'Operator Kasi Pidum',
        'operator-kasi-pidsus' => 'Operator Kasi Pidsus',
    ];
}
