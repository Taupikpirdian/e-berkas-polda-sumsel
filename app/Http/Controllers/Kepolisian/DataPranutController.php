<?php

namespace App\Http\Controllers\Kepolisian;

use App\AssignPerkara;
use App\AssignPerkaraToOperator;
use App\Constant;
use App\Conversation;
use App\FilePerkara;
use App\Http\Controllers\Controller;
use App\Http\Repositories\AuthRepository;
use App\Http\Repositories\KejaksaanRepository;
use App\Http\Repositories\PenyidikRepository;
use App\Http\Repositories\SpdpRepository;
use App\Http\Requests\SpdpRequest;
use App\Notification;
use App\Penyidik;
use App\PenyidikPerkara;
use App\Perkara;
use DevRaeph\PDFPasswordProtect\Facade\PDFPasswordProtect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DataPranutController extends Controller
{
    public function __construct(
        AuthRepository $repoAuth,
        SpdpRepository $repoSpdp
    ) {
        $this->repoAuth = $repoAuth;
        $this->repoSpdp = $repoSpdp;

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
        $filter = $request->filter;
        return view('datatable.data-pranut', compact('filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**
         * check user penyidik apa sudah terdaftar / lengkap datanya
         */
        if ($this->role == 'kepolisian') {
            // check kelengkapan data
            $dataPenyidik = (new PenyidikRepository)->penyidikByUserId($this->user->id);
            if (!$dataPenyidik) {
                return redirect()->route('data-prapenuntutan.index')->with(['redirect-sweat' => 'Data profil belum lengkap, harap melengkapi data terlebih dahulu']);
            }
            /**
             * check mapping data, user ini sudah dimapping atau belum
             */
            $akses = (new PenyidikRepository)->aksesByUserId($this->user->id);
            if (!$akses) {
                return redirect()->route('data-prapenuntutan.index')->with(['error' => 'Mohon maaf, Anda belum memiliki Akses ke Satuan Kerja manapun, mohon untuk menghubungi Admin!']);
            }

            return view('kepolisian.laporan-perkara.create-perkara');
        } else {
            return redirect()->route('data-prapenuntutan.index')->with(['error' => 'Mohon maaf, Anda tidak memiliki akses ke dalam fitur ini!']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpdpRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // decrypt
        $id = helperDecrypt($id);
        // is read notif
        if (isset($request->mode)) {
            // update notif is read
            $notif = Notification::where('is_read', Constant::IS_NOT_READ)
                ->where('data_id', $id)
                ->where('notif_for', Auth::user()->id)
                ->first();
            if ($notif) {
                // update is read
                $notif->is_read = 1;
                $notif->save();
            }
        }

        return view('datatable.detail-laporan-perkara', compact('id'));
    }

    public function uploadBerkasLanjutan(Request $request)
    {
        DB::beginTransaction();

        if ($request->hasFile('file_berkas_lanjutan')) {
            $file = $request->file('file_berkas_lanjutan');

            $ext = $file->getClientOriginalExtension();
            $name = $codeFile . "-" . str_replace(' ', '', $request->no_lp) . "-" . date('YmdHis') . '.' . $ext;
            Storage::disk('public')->putFileAs('file_berkas_lanjutan', $file, $name);
            $file_perkara = FilePerkara::where('perkara_id', $id)->first();
            $file_perkara->code_file = Constant::P16;
            $file_perkara->original_name = $file->getClientOriginalName();
            $file_perkara->name = $name;
            $file_perkara->type_file = $ext;
            $file_perkara->save();

            DB::commit();
            return json_encode(true);
        } else {
            DB::rollback();
            return json_encode(false);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('kepolisian.laporan-perkara.edit-perkara', compact('id'));
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
        DB::beginTransaction();
        try {
            $perkara = Perkara::find($id);
            $perkara->date_no_lp = $request->date_no_lp;
            $perkara->no_lp = $request->no_lp;
            $perkara->save();

            if ($request->file('files')) {
                $file = $request->file('files');

                $ext = $file->getClientOriginalExtension();
                $name = $codeFile . "-" . str_replace(' ', '', $request->no_lp) . "-" . date('YmdHis') . '.' . $ext;

                Storage::disk('public')->putFileAs('files', $file, $name);
                $file_perkara = FilePerkara::where('perkara_id', $id)->first();
                $file_perkara->code_file = Constant::SPDP;
                $file_perkara->original_name = $file->getClientOriginalName();
                $file_perkara->name = $name;
                $file_perkara->type_file = $ext;
                $file_perkara->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('laporan-perkara.index')->with(['error' => 'Update perkara gagal : ']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $perkara = Perkara::find($id);
            $file_perkara = FilePerkara::where('perkara_id', $id);
            $perkara->delete();
            $file_perkara->delete();
            return redirect()->route('laporan-perkara.index')->with(['flash-store' => 'Berhasil hapus perkara']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('laporan-perkara.index')->with(['error' => 'Hapus perkara gagal : ']);
        }
    }

    // create assign jaksa
    public function assignJaksa(Request $request)
    {
        $user_id = Auth::user()->id;
        /**
         * multiple jaksa
         */
        $list_jaksa = $request->jaksa;
        $list_operator = $request->operator ? $request->operator : [];

        DB::beginTransaction();
        try {
            // assign to jaksa
            foreach ($list_jaksa as $jaksa_penuntut_umum_id) {
                AssignPerkara::updateOrCreate(
                    [
                        'jaksa_penuntut_umum_id' => $jaksa_penuntut_umum_id,
                        'perkara_id' => $request->perkara_id,
                    ],
                    [
                        'catatan' => $request->catatan,
                    ]
                );

                // get no lp
                $perkara = Perkara::where('id', $request->perkara_id)->first();
                if ($perkara) {
                    // notif for jaksa
                    $text = 'Pemberian Tugas untuk no lp ' . $perkara->no_lp;
                    $req = [
                        'user_id' => $user_id, // user_id admin-kejaksaan
                        'notif_for' => (new KejaksaanRepository)->userJaksaByJaksaId($jaksa_penuntut_umum_id)->user_id, // user_id jaksa
                        'desc' => $text,
                        'data_id' => $perkara->id,
                        'notif_fitur' => 'Assign Jaksa',
                        'notif_type' => Constant::NOTIF_PRANUT,
                    ];

                    notificationOne($req);
                }
            }
            // assign to operator
            foreach ($list_operator as $lOp) {
                AssignPerkaraToOperator::create(
                    [
                        'user_id' => $lOp,
                        'perkara_id' => $request->perkara_id,
                    ]
                );

                // get no lp
                $perkara = Perkara::where('id', $request->perkara_id)->first();
                if ($perkara) {
                    // notif for operator
                    $text = 'Pemberian Tugas untuk no lp ' . $perkara->no_lp;
                    $req = [
                        'user_id' => $user_id, // user_id admin-kejaksaan
                        'notif_for' => $lOp, // user_id operator
                        'desc' => $text,
                        'data_id' => $perkara->id,
                        'notif_fitur' => 'Assign Operator',
                        'notif_type' => Constant::NOTIF_PRANUT,
                    ];

                    notificationOne($req);
                }
            }
            // save file
            $file = $request->file('files');
            $codeFile = Constant::P16;
            $folder = 'files' . DIRECTORY_SEPARATOR . $perkara->id;
            if ($file) {
                $rand = (new SpdpRepository)->generateRandomString();
                $ext = $file->getClientOriginalExtension();
                $name = $codeFile . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
                Storage::disk('public')->putFileAs($folder, $file, $name);
                // save db
                FilePerkara::create([
                    'code_id' => $codeFile,
                    'perkara_id' => $perkara->id,
                    'original_name' => $file->getClientOriginalName(),
                    'name' => $name,
                    'type_file' => $ext,
                    'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    'created_by' => Auth::user()->id,
                    'catatan' => $request->catatan,
                ]);
            }

            $perkara = Perkara::where('id', $perkara->id)->first();
            $oneweekfromnow = strtotime("+1 week", strtotime($perkara->created_at));
            $customeDate = date('Y-m-d H:i:s', $oneweekfromnow);

            $perkara->status = Constant::ON_PROGRESS;
            $perkara->dead_line_upload_berkas = $customeDate;
            $perkara->save();

            // notif for kepolisian
            $text = 'Telah ditugaskan jaksa untuk no lp ' . $perkara->no_lp;
            $req = [
                'user_id' => $user_id,
                'notif_for' => $perkara->user_id,
                'desc' => $text,
                'data_id' => $perkara->id,
                'notif_fitur' => 'Assign Jaksa',
                'notif_type' => Constant::NOTIF_PRANUT,
            ];

            notificationOne($req);
            DB::commit();
            return redirect()->route('data-prapenuntutan.index')->with(['success' => 'Berhasil assign jaksa']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function addFileJaksa(Request $request)
    {
        $user_id = Auth::user()->id;
        $file = $request->file('files');
        if ($file) {
            $ext = $file->getClientOriginalExtension();
            $codeFile = Constant::P17;
            $name = $codeFile . "-" . str_replace(' ', '', $request->no_lp) . "-" . date('YmdHis') . '.' . $ext;

            Storage::disk('public')->putFileAs('files', $file, $name);
            // save db
            FilePerkara::create([
                'code_id' => $codeFile,
                'perkara_id' => $request->perkara_id,
                'original_name' => $file->getClientOriginalName(),
                'name' => $name,
                'type_file' => $ext,
                'catatan' => $request->catatan,
            ]);
        }

        // notif for kepolisian
        $perkara = Perkara::where('id', $request->perkara_id)->first();

        $text = 'Jaksa mengirim P17 untuk no lp ' . $perkara->no_lp;
        $req = [
            'user_id' => $user_id,
            'notif_for' => $perkara->user_id,
            'desc' => $text,
            'notif_fitur' => 'Kirim P17',
            'notif_type' => Constant::NOTIF_PRANUT,
        ];
        notificationOne($req);

        return redirect()->route('datatable.data-pranut')->with(['flash-store' => 'Berhasil tambah file P17']);
    }

    public function encryptPdfDevRaeph($fromPath, $toPath, $password)
    {
        return PDFPasswordProtect::encrypt($fromPath, $toPath, $password);
    }

    public function download($id)
    {
        // decrypt
        $id = helperDecrypt($id);
        $data = FilePerkara::where('id', $id)->first();

        if ($data) {
            ob_end_clean(); // this
            ob_start(); // and this

            $name = $data->name;
            $originalName = $data->original_name;
            $perkara_id = $data->perkara_id;
            $mainPath = DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR;
            $path = $data->path != null ? $data->path : 'files' . DIRECTORY_SEPARATOR . $perkara_id . DIRECTORY_SEPARATOR . $name;
            $file = storage_path() . $mainPath . $path;

            // PDFPasswordProtect::encrypt(storage_path('pdf/document.pdf'), storage_path('pdf/' . 'encrypted-documented.pdf'), 'aa');

            $content_type = "";
            if ($data['type_file'] == "pdf") {
                $content_type = "application/pdf";
            } else {
                $content_type = "image/" . $data['type_file'];
            }

            $header = [
                'Content-Type: ' . $content_type,
            ];

            return response()->download($file, $originalName, $header);
            // for show pdf
            // return response()->download($file, $originalName, $header, 'inline');
        } else {
            return redirect()->back()->with(['error' => 'File Tidak ada']);
        }
    }

    public function downloadOnDiscussion($id)
    {
        // decrypt
        $id = helperDecrypt($id);
        $data = Conversation::where('id', $id)->first();

        if ($data) {
            ob_end_clean(); // this
            ob_start(); // and this

            $name = $data->original_name;
            $file = storage_path() . '/app/public/' . $data->message;
            $content_type = "application/pdf";

            $header = [
                'Content-Type: ' . $content_type,
            ];

            return response()->download($file, $name, $header);
        } else {
            return redirect()->back()->with(['error' => 'File Tidak ada']);
        }
    }

    public function storeBerkas(Request $request)
    {
        $user_id = Auth::user()->id;
        DB::beginTransaction();
        try {
            $file = $request->file('files');
            $codeFile = Constant::RESUME_BERKAS_PERKARA;
            $folder = 'files' . DIRECTORY_SEPARATOR . $request->perkara_id;
            if ($file) {
                $rand = (new SpdpRepository)->generateRandomString();
                $ext = $file->getClientOriginalExtension();
                $name = $codeFile . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;

                Storage::disk('public')->putFileAs($folder, $file, $name);

                // save db
                FilePerkara::create([
                    'code_id' => $codeFile,
                    'perkara_id' => $request->perkara_id,
                    'original_name' => $file->getClientOriginalName(),
                    'name' => $name,
                    'type_file' => $ext,
                    'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    'created_by' => Auth::user()->id,
                    'catatan' => $request->catatan,
                ]);
            }

            $perkara = Perkara::where('id', $request->perkara_id)->first();

            $dateNow = date('Y-m-d H:i:s');
            $oneweekfromnow = strtotime("+1 week", strtotime($dateNow));
            $customeDate = date('Y-m-d H:i:s', $oneweekfromnow);

            $perkara->updated_by = $user_id;
            $perkara->status_dead_line_upload_berkas = Constant::SUDAH_UPLOAD;
            $perkara->dead_line_response_jaksa = $customeDate;
            $perkara->status_dead_line_response_jaksa = Constant::PERLU_RESPONSE;
            $perkara->updated_at = $dateNow;
            $perkara->save();

            // notif for kejaksaan
            $text = 'Telah upload berkas untuk no lp ' . $perkara->no_lp;
            // get data jaksa, lalu loop
            $arrayJaksaAssignee = (new KejaksaanRepository)->jaksaAssingPerkaraByPerkaraId($request->perkara_id);
            foreach ($arrayJaksaAssignee as $assignJaksa) {
                if ($assignJaksa->masterJaksa) {
                    $req = [
                        'user_id' => $user_id,
                        'notif_for' => $assignJaksa->masterJaksa->user_id,
                        'desc' => $text,
                        'data_id' => $perkara->id,
                        'notif_fitur' => 'Upload Berkas',
                        'notif_type' => Constant::NOTIF_PRANUT,
                    ];

                    notificationOne($req);
                }
            }

            DB::commit();
            return redirect()->route('data-prapenuntutan.index')->with(['success' => 'Berhasil upload berkas']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function storeP17(Request $request)
    {
        $user_id = Auth::user()->id;
        DB::beginTransaction();
        try {
            $file = $request->file('files');
            $codeFile = Constant::P17;
            $folder = 'files' . DIRECTORY_SEPARATOR . $request->perkara_id;
            if ($file) {
                $rand = (new SpdpRepository)->generateRandomString();
                $ext = $file->getClientOriginalExtension();
                $name = $codeFile . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;

                Storage::disk('public')->putFileAs($folder, $file, $name);

                // save db
                FilePerkara::create([
                    'code_id' => $codeFile,
                    'perkara_id' => $request->perkara_id,
                    'original_name' => $file->getClientOriginalName(),
                    'name' => $name,
                    'type_file' => $ext,
                    'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    'created_by' => Auth::user()->id,
                    'catatan' => $request->catatan,
                ]);
            }

            $perkara = Perkara::where('id', $request->perkara_id)->first();
            $perkara->updated_by = $user_id;
            $perkara->updated_at = date('Y-m-d H:i:s');
            $perkara->save();

            // notif for kejaksaan
            $text = 'Telah upload P17 untuk no lp ' . $perkara->no_lp;
            $req = [
                'user_id' => $user_id,
                'notif_for' => $perkara->user_id,
                'desc' => $text,
                'data_id' => $perkara->id,
                'notif_fitur' => 'Upload P17',
                'notif_type' => Constant::NOTIF_PRANUT,
            ];

            notificationOne($req);

            DB::commit();
            return redirect()->route('data-prapenuntutan.index')->with(['success' => 'Berhasil upload P17']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function storeSop02(Request $request)
    {
        $user_id = Auth::user()->id;
        DB::beginTransaction();
        try {
            $file = $request->file('files');
            $codeFile = Constant::SOP_02;
            $folder = 'files' . DIRECTORY_SEPARATOR . $request->perkara_id;
            if ($file) {
                $rand = (new SpdpRepository)->generateRandomString();
                $ext = $file->getClientOriginalExtension();
                $name = $codeFile . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;

                Storage::disk('public')->putFileAs($folder, $file, $name);

                // save db
                FilePerkara::create([
                    'code_id' => $codeFile,
                    'perkara_id' => $request->perkara_id,
                    'original_name' => $file->getClientOriginalName(),
                    'name' => $name,
                    'type_file' => $ext,
                    'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    'created_by' => Auth::user()->id,
                    'catatan' => $request->catatan,
                ]);
            }

            $perkara = Perkara::where('id', $request->perkara_id)->first();
            $perkara->updated_by = $user_id;
            $perkara->updated_at = date('Y-m-d H:i:s');
            $perkara->save();

            // notif for kejaksaan
            $text = 'Telah upload SOP Form 02 untuk no lp ' . $perkara->no_lp;
            $req = [
                'user_id' => $user_id,
                'notif_for' => $perkara->user_id,
                'desc' => $text,
                'data_id' => $perkara->id,
                'notif_fitur' => 'Upload SOP Form 02',
                'notif_type' => Constant::NOTIF_PRANUT,
            ];

            notificationOne($req);

            DB::commit();
            return redirect()->route('data-prapenuntutan.index')->with(['success' => 'Berhasil upload P17']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function storeP18(Request $request)
    {
        $user_id = Auth::user()->id;
        DB::beginTransaction();
        try {
            $file = $request->file('files');
            $codeFile = Constant::P18;
            $folder = 'files' . DIRECTORY_SEPARATOR . $request->perkara_id;
            if ($file) {
                $rand = (new SpdpRepository)->generateRandomString();
                $ext = $file->getClientOriginalExtension();
                $name = $codeFile . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;

                Storage::disk('public')->putFileAs($folder, $file, $name);

                // save db
                FilePerkara::create([
                    'code_id' => $codeFile,
                    'perkara_id' => $request->perkara_id,
                    'original_name' => $file->getClientOriginalName(),
                    'name' => $name,
                    'type_file' => $ext,
                    'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    'created_by' => Auth::user()->id,
                    'catatan' => $request->catatan,
                ]);
            }

            $perkara = Perkara::where('id', $request->perkara_id)->first();
            $dateNow = date('Y-m-d H:i:s');
            $oneweekfromnow = strtotime("+2 week", strtotime($dateNow));
            $customeDate = date('Y-m-d H:i:s', $oneweekfromnow);

            $perkara->updated_by = $user_id;
            $perkara->status_dead_line_upload_berkas = Constant::PERLU_UPLOAD_KEMBALI;
            $perkara->dead_line_upload_berkas = $customeDate;
            $perkara->status_dead_line_response_jaksa = Constant::SUDAH_RESPONSE;
            $perkara->updated_at = $dateNow;
            $perkara->save();

            // notif for kejaksaan
            $text = 'Telah upload P18 untuk no lp ' . $perkara->no_lp;
            $req = [
                'user_id' => $user_id,
                'notif_for' => $perkara->user_id,
                'desc' => $text,
                'data_id' => $perkara->id,
                'notif_fitur' => 'Upload P18',
                'notif_type' => Constant::NOTIF_PRANUT,
            ];

            notificationOne($req);

            DB::commit();
            return redirect()->route('data-prapenuntutan.index')->with(['success' => 'Berhasil upload P18']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function storeP19(Request $request)
    {
        $user_id = Auth::user()->id;
        DB::beginTransaction();
        try {
            $file = $request->file('files');
            $codeFile = Constant::P19;
            $folder = 'files' . DIRECTORY_SEPARATOR . $request->perkara_id;
            if ($file) {
                $rand = (new SpdpRepository)->generateRandomString();
                $ext = $file->getClientOriginalExtension();
                $name = $codeFile . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;

                Storage::disk('public')->putFileAs($folder, $file, $name);

                // save db
                FilePerkara::create([
                    'code_id' => $codeFile,
                    'perkara_id' => $request->perkara_id,
                    'original_name' => $file->getClientOriginalName(),
                    'name' => $name,
                    'type_file' => $ext,
                    'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    'created_by' => Auth::user()->id,
                    'catatan' => $request->catatan,
                ]);
            }

            $perkara = Perkara::where('id', $request->perkara_id)->first();
            $dateNow = date('Y-m-d H:i:s');
            $oneweekfromnow = strtotime("+2 week", strtotime($dateNow));
            $customeDate = date('Y-m-d H:i:s', $oneweekfromnow);

            $perkara->updated_by = $user_id;
            $perkara->status_dead_line_upload_berkas = Constant::PERLU_UPLOAD_KEMBALI;
            $perkara->dead_line_upload_berkas = $customeDate;
            $perkara->status_dead_line_response_jaksa = Constant::SUDAH_RESPONSE;
            $perkara->updated_at = $dateNow;
            $perkara->save();

            // notif for kejaksaan
            $text = 'Telah upload P19 untuk no lp ' . $perkara->no_lp;
            $req = [
                'user_id' => $user_id,
                'notif_for' => $perkara->user_id,
                'desc' => $text,
                'data_id' => $perkara->id,
                'notif_fitur' => 'Upload P19',
                'notif_type' => Constant::NOTIF_PRANUT,
            ];

            notificationOne($req);

            DB::commit();
            return redirect()->route('data-prapenuntutan.index')->with(['success' => 'Berhasil upload P18']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function storeP20(Request $request)
    {
        $user_id = Auth::user()->id;
        DB::beginTransaction();
        try {
            $file = $request->file('files');
            $codeFile = Constant::P20;
            $folder = 'files' . DIRECTORY_SEPARATOR . $request->perkara_id;
            if ($file) {
                $rand = (new SpdpRepository)->generateRandomString();
                $ext = $file->getClientOriginalExtension();
                $name = $codeFile . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;

                Storage::disk('public')->putFileAs($folder, $file, $name);

                // save db
                FilePerkara::create([
                    'code_id' => $codeFile,
                    'perkara_id' => $request->perkara_id,
                    'original_name' => $file->getClientOriginalName(),
                    'name' => $name,
                    'type_file' => $ext,
                    'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    'created_by' => Auth::user()->id,
                    'catatan' => $request->catatan,
                ]);
            }

            $perkara = Perkara::where('id', $request->perkara_id)->first();
            $perkara->updated_by = $user_id;
            $perkara->updated_at = date('Y-m-d H:i:s');
            $perkara->status_dead_line_response_jaksa = Constant::SUDAH_RESPONSE;
            $perkara->save();

            // notif for kejaksaan
            $text = 'Telah upload P20 untuk no lp ' . $perkara->no_lp;
            $req = [
                'user_id' => $user_id,
                'notif_for' => $perkara->user_id,
                'desc' => $text,
                'data_id' => $perkara->id,
                'notif_fitur' => 'Upload P20',
                'notif_type' => Constant::NOTIF_PRANUT,
            ];

            notificationOne($req);

            DB::commit();
            return redirect()->route('data-prapenuntutan.index')->with(['success' => 'Berhasil upload P20']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function storeP21(Request $request)
    {
        $user_id = Auth::user()->id;
        DB::beginTransaction();
        try {
            $file = $request->file('files');
            $codeFile = Constant::P21;
            $folder = 'files' . DIRECTORY_SEPARATOR . $request->perkara_id;
            if ($file) {
                $rand = (new SpdpRepository)->generateRandomString();
                $ext = $file->getClientOriginalExtension();
                $name = $codeFile . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;

                Storage::disk('public')->putFileAs($folder, $file, $name);

                // save db
                FilePerkara::create([
                    'code_id' => $codeFile,
                    'perkara_id' => $request->perkara_id,
                    'original_name' => $file->getClientOriginalName(),
                    'name' => $name,
                    'type_file' => $ext,
                    'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    'created_by' => Auth::user()->id,
                    'catatan' => $request->catatan,
                ]);

                $perkara = Perkara::where('id', $request->perkara_id)->first();
                $perkara->status = Constant::TAHAP_II;
                $perkara->updated_by = $user_id;
                $perkara->status_dead_line_response_jaksa = Constant::SUDAH_RESPONSE;
                $perkara->updated_at = date('Y-m-d H:i:s');
                $perkara->save();

                // notif for kejaksaan
                $text = 'Telah upload P21 untuk no lp ' . $perkara->no_lp;
                $req = [
                    'user_id' => $user_id,
                    'notif_for' => $perkara->user_id,
                    'desc' => $text,
                    'data_id' => $perkara->id,
                    'notif_fitur' => 'Upload P21',
                    'notif_type' => Constant::NOTIF_PRANUT,
                ];

                notificationOne($req);
            }

            DB::commit();
            return redirect()->route('data-prapenuntutan.index')->with(['success' => 'Berhasil upload P21']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function storeP21A(Request $request)
    {
        $user_id = Auth::user()->id;
        DB::beginTransaction();
        try {
            $file = $request->file('files');
            $codeFile = Constant::P21A;
            $folder = 'files' . DIRECTORY_SEPARATOR . $request->perkara_id;
            if ($file) {
                $rand = (new SpdpRepository)->generateRandomString();
                $ext = $file->getClientOriginalExtension();
                $name = $codeFile . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;

                Storage::disk('public')->putFileAs($folder, $file, $name);

                // save db
                FilePerkara::create([
                    'code_id' => $codeFile,
                    'perkara_id' => $request->perkara_id,
                    'original_name' => $file->getClientOriginalName(),
                    'name' => $name,
                    'type_file' => $ext,
                    'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    'created_by' => Auth::user()->id,
                    'catatan' => $request->catatan,
                ]);
            }

            $perkara = Perkara::where('id', $request->perkara_id)->first();
            $perkara->status = Constant::TAHAP_II;
            $perkara->status_dead_line_response_jaksa = Constant::SUDAH_RESPONSE;
            $perkara->updated_by = $user_id;
            $perkara->updated_at = date('Y-m-d H:i:s');
            $perkara->save();

            // notif for kejaksaan
            $text = 'Telah upload P21A untuk no lp ' . $perkara->no_lp;
            $req = [
                'user_id' => $user_id,
                'notif_for' => $perkara->user_id,
                'desc' => $text,
                'data_id' => $perkara->id,
                'notif_fitur' => 'Upload P21A',
                'notif_type' => Constant::NOTIF_PRANUT,
            ];

            notificationOne($req);

            DB::commit();
            return redirect()->route('data-prapenuntutan.index')->with(['success' => 'Berhasil upload P21A']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function storeBerkasKembali(Request $request)
    {
        $user_id = Auth::user()->id;
        DB::beginTransaction();
        try {
            $file = $request->file('files');
            $codeFile = Constant::BERKAS_KEMBALI;
            $folder = 'files' . DIRECTORY_SEPARATOR . $request->perkara_id;
            if ($file) {
                $rand = (new SpdpRepository)->generateRandomString();
                $ext = $file->getClientOriginalExtension();
                $name = $codeFile . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;

                Storage::disk('public')->putFileAs($folder, $file, $name);

                // save db
                FilePerkara::create([
                    'code_id' => $codeFile,
                    'perkara_id' => $request->perkara_id,
                    'original_name' => $file->getClientOriginalName(),
                    'name' => $name,
                    'type_file' => $ext,
                    'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    'created_by' => Auth::user()->id,
                    'catatan' => $request->catatan,
                ]);
            }

            $perkara = Perkara::where('id', $request->perkara_id)->first();
            $perkara->updated_by = $user_id;
            $perkara->updated_at = date('Y-m-d H:i:s');
            $perkara->status = Constant::CLOSE;
            $perkara->save();

            // notif for kejaksaan
            $text = 'Telah upload Berkas Kembali untuk no lp ' . $perkara->no_lp;
            $req = [
                'user_id' => $user_id,
                'notif_for' => $perkara->user_id,
                'desc' => $text,
                'data_id' => $perkara->id,
                'notif_fitur' => 'Upload Berkas Kembali',
                'notif_type' => Constant::NOTIF_PRANUT,
            ];

            notificationOne($req);

            DB::commit();
            return redirect()->route('data-prapenuntutan.index')->with(['success' => 'Berhasil upload P17']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function storeTahap2(Request $request)
    {
        $user_id = Auth::user()->id;
        $arrayFile = array(
            array(
                "code" => Constant::PENGANTAR_TAHAP_II,
                "file" => $request->file_surat_pengantar,
            ),
            array(
                "code" => Constant::SPHAN,
                "file" => $request->file_sphan,
            ),
            array(
                "code" => Constant::BAHAN,
                "file" => $request->file_bahan,
            ),
            array(
                "code" => Constant::SPKAP,
                "file" => $request->file_spkap,
            ),
            array(
                "code" => Constant::BAKAP,
                "file" => $request->file_bakap,
            ),
            array(
                "code" => Constant::KTP_KK,
                "file" => $request->file_ktp,
            ),
        );

        DB::beginTransaction();
        try {
            foreach ($arrayFile as $af) {
                $file = $af['file'];
                $folder = 'files' . DIRECTORY_SEPARATOR . $request->perkara_id;
                if ($file) {
                    $rand = (new SpdpRepository)->generateRandomString();
                    $ext = $file->getClientOriginalExtension();
                    $name = $af['code'] . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;

                    Storage::disk('public')->putFileAs($folder, $file, $name);

                    // save db
                    FilePerkara::create([
                        'code_id' => $af['code'],
                        'perkara_id' => $request->perkara_id,
                        'original_name' => $file->getClientOriginalName(),
                        'name' => $name,
                        'type_file' => $ext,
                        'path' => $folder . DIRECTORY_SEPARATOR . $name,
                        'created_by' => Auth::user()->id,
                        'catatan' => '',
                    ]);
                }

                $perkara = Perkara::where('id', $request->perkara_id)->first();
                $perkara->updated_by = $user_id;
                $perkara->updated_at = date('Y-m-d H:i:s');
                $perkara->status = Constant::LENGKAP;
                $perkara->save();
            }

            // notif for kejaksaan
            $text = 'Telah upload berkas tahap II no lp ' . $perkara->no_lp;
            // get data jaksa, lalu loop
            $arrayJaksaAssignee = (new KejaksaanRepository)->jaksaAssingPerkaraByPerkaraId($request->perkara_id);
            foreach ($arrayJaksaAssignee as $assignJaksa) {
                if ($assignJaksa->masterJaksa) {
                    $req = [
                        'user_id' => $user_id,
                        'notif_for' => $assignJaksa->masterJaksa->user_id,
                        'desc' => $text,
                        'data_id' => $perkara->id,
                        'notif_fitur' => 'Upload Berkas Tahap II',
                        'notif_type' => Constant::NOTIF_PRANUT,
                    ];

                    notificationOne($req);
                }
            }

            DB::commit();
            return redirect()->route('data-prapenuntutan-lengkap.index')->with(['success' => 'Berhasil upload Berkas Tahap II']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function hentikanPerkara(Request $request)
    {
        $user_id = Auth::user()->id;
        DB::beginTransaction();
        try {
            $file = $request->file('files');
            $codeFile = Constant::PENGHENTIAN_PERKARA;
            $folder = 'files' . DIRECTORY_SEPARATOR . $request->perkara_id;
            if ($file) {
                $rand = (new SpdpRepository)->generateRandomString();
                $ext = $file->getClientOriginalExtension();
                $name = $codeFile . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;

                Storage::disk('public')->putFileAs($folder, $file, $name);

                // save db
                FilePerkara::create([
                    'code_id' => $codeFile,
                    'perkara_id' => $request->perkara_id,
                    'original_name' => $file->getClientOriginalName(),
                    'name' => $name,
                    'type_file' => $ext,
                    'path' => $folder . DIRECTORY_SEPARATOR . $name,
                    'created_by' => Auth::user()->id,
                    'catatan' => $request->catatan,
                ]);
            }

            $perkara = Perkara::where('id', $request->perkara_id)->first();
            $perkara->updated_by = $user_id;
            $perkara->updated_at = date('Y-m-d H:i:s');
            $perkara->status = $request->status;
            $perkara->save();

            // notif for kejaksaan
            $text = 'Telah dihentikan perkara untuk no lp ' . $perkara->no_lp;
            // get data jaksa, lalu loop
            $arrayJaksaAssignee = (new KejaksaanRepository)->jaksaAssingPerkaraByPerkaraId($request->perkara_id);
            foreach ($arrayJaksaAssignee as $assignJaksa) {
                if ($assignJaksa->masterJaksa) {
                    $req = [
                        'user_id' => $user_id,
                        'notif_for' => $assignJaksa->masterJaksa->user_id,
                        'desc' => $text,
                        'data_id' => $perkara->id,
                        'notif_fitur' => 'Penghentian Perkara',
                        'notif_type' => Constant::NOTIF_PRANUT,
                    ];
                    notificationOne($req);
                }
            }

            // notif for penyidik
            $req = [
                'user_id' => $user_id,
                'notif_for' => $perkara->user_id,
                'desc' => $text,
                'data_id' => $perkara->id,
                'notif_fitur' => 'Penghentian Perkara',
                'notif_type' => Constant::NOTIF_PRANUT,
            ];
            notificationOne($req);

            DB::commit();
            return redirect()->route('data-prapenuntutan.index')->with(['success' => 'Berhasil Menghentikan Perkara']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function splitTersangka($id)
    {
        return view('kepolisian.split-tersangka.index', compact('id'));
    }

    public function updatePenyidikByPerkara(Request $request)
    {
        DB::beginTransaction();
        try {
            Perkara::updateOrCreate(
              [
                'id' => $request->perkara_id,
              ],
              [
                'user_id' => $request->penyidik_id,
                'updated_by' => Auth::user()->id,
              ]);
            DB::commit();
            return redirect()->route('data-prapenuntutan.index')->with(['success' => 'Berhasil ubah penyidik']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function editJaksa(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach($request->jaksa as $jaksa) {
                AssignPerkara::updateOrCreate(
                    [
                      'perkara_id' => $request->perkara_id,
                    ],
                    [
                      'jaksa_penuntut_umum_id' => $jaksa,
                    ]);
            }
            DB::commit();
            return redirect()->route('data-prapenuntutan.index')->with(['success' => 'Berhasil ubah jaksa']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

}

