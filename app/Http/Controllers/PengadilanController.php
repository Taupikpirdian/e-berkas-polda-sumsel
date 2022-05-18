<?php

namespace App\Http\Controllers;

use App\User;
use App\Constant;
use App\IzinSita;
use App\IzinGeledah;
use App\Notification;
use App\IzinPengadilan;
use App\FileIzinPengadilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\StoreIzinSitaServices;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Repositories\SpdpRepository;
use App\Services\StoreIzinGeledahServices;

class PengadilanController extends Controller
{
    public function __construct()
    {
        $this->year = date('Y');
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->role = $this->user->roles->pluck('name')[0];
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $label = '';

        $fitur = $request->fitur ? $request->fitur : '';
        if ($fitur == 'izin-geledah') {
            $label = 'Izin Geledah';
        } elseif ($fitur == 'izin-sita') {
            $label = 'Izin Sita';
        }

        return view('datatable.master-pengadilan.index', compact('fitur', 'label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $label = '';

        $fitur = $request->fitur ? $request->fitur : '';
        if ($fitur == 'izin-geledah') {
            $label = 'Izin Geledah';
        } elseif ($fitur == 'izin-sita') {
            $label = 'Izin Sita';
        }
        return view('izin-pengadilan.create', compact('fitur', 'label'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $check_data = User::where(['id' => $user_id])->first();
        $fitur = $request->fitur ? $request->fitur : '';
        // check PIN
        $resPin = checkPin($request->pin, $check_data->pin);
        if (!$resPin) {
            return Redirect::back()->with(['error' => 'PIN yang anda masukan salah']);
        }
        $flash_store = '';

        if ($fitur == 'izin-geledah') {
            // use services
            $flash_store = (new StoreIzinGeledahServices())->store($request, $user_id);
        } elseif ($fitur == 'izin-sita') {
            $flash_store = (new StoreIzinSitaServices())->store($request, $user_id);
        }

        if ($flash_store) {
            return Redirect::to('/izin-pengadilan?fitur=' . $fitur)->with(['flash-store' => $flash_store]);
        } else {
            return Redirect::to('/izin-pengadilan?fitur=' . $fitur)->with(['error' => 'Gagal simpan data']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $fitur = $request->fitur ? $request->fitur : '';
        $label = $fitur == 'izin-sita' ? 'Izin Sita' : 'Izin Geledah';
        // decrypt
        $id = helperDecrypt($id);
        // is read notif
        if (isset($request->mode)) {
            // update notif is read
            $notif = Notification::where('is_read', Constant::IS_NOT_READ)
                ->where('data_id', $id)
                ->where('notif_fitur', $fitur)
                ->where('notif_for', Auth::user()->id)
                ->first();
            if ($notif) {
                // update is read
                $notif->is_read = Constant::IS_READ;
                $notif->save();
            }
        }

        try {
            $data = IzinPengadilan::with([
                'pihak',
                'filePengajuan',
                'fileBalasan',
                'pengadilan',
                'fileIzin'
            ])->find($id);

            return view('datatable.master-pengadilan.show', compact('data', 'fitur', 'label'));
        } catch (\Exception $e) {
            return Redirect::to('/izin-pengadilan?fitur=' . $fitur)->with(['error' => 'Error : ' . $e->getMessage()]);
        }
    }

    function masterFileGeledah($id)
    {
        $master_berkas = [
            Constant::SURAT_PERMOHONAN => (object) array(
                'name_file' => 'Surat Permohonan',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::RESUME_LAPJU => (object) array(
                'name_file' => 'Resume / Lapju',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::SPDP => (object) array(
                'name_file' => 'SPDP',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::SURAT_PERINTAH_PENYIDIKAN => (object) array(
                'name_file' => 'Surat Perintah Penyidikan',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::SURAT_PERINTAH_PENYELIDIKAN => (object) array(
                'name_file' => 'Surat Perintah Penyelidikan',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::SURAT_PERINTAH_PENGGELEDAHAN => (object) array(
                'name_file' => 'Surat Perintah Penggeledahan',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::BERITA_ACARA_PENGGELEDAHAN => (object) array(
                'name_file' => 'Berita Acara Penggeledahan',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::BERITA_ACARA_KETERANGAN_SAKSI_TERSANGKA => (object) array(
                'name_file' => 'Berita Acara Keterangan Saksi Tersangka',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::SURAT_TANDA_PENERIMAAN_BARANG_BUKTI => (object) array(
                'name_file' => 'Surat Tanda Penerimaan Barang Bukti',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::LAPORAN_POLISI => (object) array(
                'name_file' => 'Laporan Polisi',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
        ];

        return $master_berkas;
    }

    function masterFileSita($id)
    {
        $master_berkas_sita = [
            Constant::SURAT_PERMOHONAN => (object) array(
                'name_file' => 'Surat Permohonan',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::RESUME_LAPJU => (object) array(
                'name_file' => 'Resume / Lapju',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::SPDP => (object) array(
                'name_file' => 'SPDP',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::SURAT_PERINTAH_PENYIDIKAN => (object) array(
                'name_file' => 'Surat Perintah Penyidikan',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::SURAT_PERINTAH_PENYELIDIKAN => (object) array(
                'name_file' => 'Surat Perintah Penyelidikan',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::SURAT_PERINTAH_PENYITAAN => (object) array(
                'name_file' => 'Surat Perintah Penyitaan',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::BERITA_ACARA_PENYITAAN => (object) array(
                'name_file' => 'Berita Acara Penyitaan',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::BERITA_ACARA_KETERANGAN_SAKSI_TERSANGKA => (object) array(
                'name_file' => 'Berita Acara Keterangan Saksi Tersangka',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::SURAT_TANDA_PENERIMAAN_BARANG_BUKTI => (object) array(
                'name_file' => 'Surat Tanda Penerimaan Barang Bukti',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
            Constant::LAPORAN_POLISI => (object) array(
                'name_file' => 'Laporan Polisi',
                'data_id' => $id,
                'file_id' => null,
                'status' => 99,
            ),
        ];

        return $master_berkas_sita;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storePengajuanIzinSita(Request $request)
    {
        $user_id = Auth::user()->id;
        DB::beginTransaction();
        try {
            $file = $request->file('files');
            $folder = 'izin-pengadilan' . DIRECTORY_SEPARATOR . $request->izin_pengadilan_id;
            if ($file) {
                $rand = (new SpdpRepository)->generateRandomString();
                $ext = $file->getClientOriginalExtension();
                $name = Constant::CODE_IZIN_SITA . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;

                
                Storage::disk('public')->putFileAs($folder, $file, $name);

                // save db
                FileIzinPengadilan::create([
                    'izin_pengadilan_id' => $request->izin_pengadilan_id,
                    'jns_file' => Constant::PENGAJUAN_IZIN_PENGADILAN,
                    'original_name' => $file->getClientOriginalName(),
                    'name' => $name,
                    'type_file' => $ext,
                    'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    'created_by' => Auth::user()->id,
                ]);
            }

            $data = IzinPengadilan::where('id', $request->izin_pengadilan_id)->first();
            $data->status = Constant::PENGAJUAN_IZIN_PENGADILAN;
            $data->updated_by = $user_id;
            $data->updated_at = date('Y-m-d H:i:s');
            $data->save();

            // notif for kejaksaan
            $text = 'Telah Pengajuan Izin Sita ' . $data->no_lp;
            $req = [
                'user_id' => $user_id,
                'notif_for' => 1, // user id pengadilan terkait
                'desc' => $text,
                'data_id' => $data->id,
                'notif_fitur' => 'Upload Pengajuan Izin Sita',
                'notif_type' => Constant::NOTIF_IZIN_SITA
            ];

            notificationOne($req);

            DB::commit();
            return redirect()->to('/izin-pengadilan?fitur=' . $data->jns_izin)->with(['success' => 'Pengajuan Berhasil']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function storeBalasanIzinSita(Request $request)
    {
        $user_id = Auth::user()->id;
        DB::beginTransaction();
        try {
            $file = $request->file('files');
            $folder = 'izin-pengadilan' . DIRECTORY_SEPARATOR . $request->izin_pengadilan_id;
            if ($file) {
                $rand = (new SpdpRepository)->generateRandomString();
                $ext = $file->getClientOriginalExtension();
                $name = Constant::CODE_IZIN_SITA . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;

                
                Storage::disk('public')->putFileAs($folder, $file, $name);

                // save db
                FileIzinPengadilan::create([
                    'izin_pengadilan_id' => $request->izin_pengadilan_id,
                    'jns_file' => Constant::BALASAN_IZIN_PENGADILAN,
                    'original_name' => $file->getClientOriginalName(),
                    'name' => $name,
                    'type_file' => $ext,
                    'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    'created_by' => Auth::user()->id,
                ]);
            }

            $data = IzinPengadilan::where('id', $request->izin_pengadilan_id)->first();
            $data->status = Constant::BALASAN_IZIN_PENGADILAN;
            $data->updated_by = $user_id;
            $data->updated_at = date('Y-m-d H:i:s');
            $data->save();

            // notif for kejaksaan
            $text = 'Telah Di Balas Pengajuan Izin Sita ' . $data->no_lp;
            $req = [
                'user_id' => $user_id,
                'notif_for' => $data->user_id, // user id pengaju
                'desc' => $text,
                'data_id' => $data->id,
                'notif_fitur' => 'Upload Balasan Izin Sita',
                'notif_type' => Constant::NOTIF_IZIN_SITA
            ];

            notificationOne($req);

            DB::commit();
            return redirect()->to('/izin-pengadilan?fitur=' . $data->jns_izin)->with(['success' => 'Balasan Berhasil']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function download($id)
    {
        // decrypt
        $id = helperDecrypt($id);
        $data = FileIzinPengadilan::where('id', $id)->first();

        if ($data) {
            ob_end_clean(); // this
            ob_start(); // and this

            $name = $data->name;
            $originalName = $data->original_name;
            $izin_pengadilan_id = $data->izin_pengadilan_id;
            $mainPath = DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR;
            $path = $data->path != NULL ? $data->path : 'files' . DIRECTORY_SEPARATOR . $izin_pengadilan_id . DIRECTORY_SEPARATOR . $name;
            $file = storage_path() . $mainPath . $path;

            $content_type = "";
            if ($data['type_file'] == "pdf") {
                $content_type = "application/pdf";
            } else {
                $content_type = "image/" . $data['type_file'];
            }

            $header = [
                'Content-Type: ' . $content_type
            ];

            return response()->download($file, $originalName, $header);
        } else {
            return redirect()->back()->with(['error' => 'File Tidak ada']);
        }
    }
}
