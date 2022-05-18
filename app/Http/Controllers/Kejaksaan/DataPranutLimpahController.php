<?php

namespace App\Http\Controllers\Kejaksaan;

use App\Constant;
use App\Http\Controllers\Controller;
use App\LimpahPerkara;
use App\Perkara;
use App\FilePerkara;
use App\Services\PerkaraServiceLimpah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;

class DataPranutLimpahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data-pranut-limpah.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    // create limpah perkara assign pengadilan
    public function assignPengadilan(Request $request)
    {
        DB::beginTransaction();
        try {
            // proses limpah perkara
            $limpahPerkara = LimpahPerkara::updateOrCreate([
                'perkara_id' => $request->perkara_id,
                'pengadilan_id' => $request->pengadilan,
                'updated_by' => Auth::user()->id
            ], [
                'catatan' => $request->catatan,
                'created_by' => Auth::user()->id
            ]);

            $file = $request->file('files');
            $codeFile = Constant::P31;

            if ($limpahPerkara && $file) {
                (new PerkaraServiceLimpah)->uploadFileLimpahPerkara($request, $codeFile, $file);
            }

            $perkara = Perkara::find($request->perkara_id);

            // notif for pengadilan
            $text = 'Limpah Perkara untuk no lp ' . $perkara->no_lp;
            $reqNotifOne = [
                'user_id' => Auth::user()->id,
                'notif_for' => $request->pengadilan, // user_id jaksa
                'desc' => $text,
                'data_id' => $perkara->id,
                'notif_fitur' => 'LIMPAH PERKARA',
                'notif_type' => Constant::NOTIF_LIMPAH,
            ];

            notificationOne($reqNotifOne);
            // kirim notif untuk admin kejaksaan
            $reqNotifMany = [
                'user_id' => Auth::user()->id,
                'desc' => $text,
                'data_id' => $perkara->id,
                'notif_type' => Constant::NOTIF_LIMPAH,
            ];
            notificationMany($reqNotifMany, 'admin-kejaksaan', 'LIMPAH PERKARA');

            DB::commit();
            return redirect()->route('data-prapenuntutan-limpah.index')->with(['success' => 'Berhasil assign pengadilan']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    // upload file limpah perkara
    public function uploadFile(Request $request)
    {
        DB::beginTransaction();
        try {
            $name_file = "limpah";
            switch ($request->code_file) {
                case Constant::P33:
                    $name_file = "P33";
                    break;
                case Constant::P34:
                    $name_file = "P34";
                    break;
                case Constant::FILE_RENDAK:
                    $name_file = "Rendak";
                    break;
                default:
                    $name_file = "P31";
                    break;
            }

            $file = $request->file('files');
            $codeFile = $request->code_file;

            if ($file) {
                (new PerkaraServiceLimpah)->uploadFileLimpahPerkara($request, $codeFile, $file);
            }

            $perkara = Perkara::find($request->perkara_id);

            $text = 'Telah upload '.$name_file.' untuk no ' . $perkara->no_lp;
            
            if ($request->code_file != Constant::P33 || $request->code_file == Constant::P31) {
                // notif for pengadilan
                $reqNotifOne = [
                    'user_id' => Auth::user()->id,
                    'notif_for' => $perkara->assignPengadilan->pengadilan_id, // user_id jaksa
                    'desc' => $text,
                    'data_id' => $perkara->id,
                    'notif_fitur' => 'LIMPAH PERKARA',
                    'notif_type' => Constant::NOTIF_LIMPAH,
                ]; 

                notificationOne($reqNotifOne);
            } else {
                // notif for kejaksaan
                foreach ($perkara->listJaksa as $key => $value) {
                    $reqNotifOne = [
                        'user_id' => Auth::user()->id,
                        'notif_for' => $value->masterJaksa->user_id, // user_id jaksa
                        'desc' => $text,
                        'data_id' => $perkara->id,
                        'notif_fitur' => 'LIMPAH PERKARA',
                        'notif_type' => Constant::NOTIF_LIMPAH,
                    ];

                    notificationOne($reqNotifOne);
                }
            }
            // kirim notif untuk admin kejaksaan
            $reqNotifMany = [
                'user_id' => Auth::user()->id,
                'desc' => $text,
                'data_id' => $perkara->id,
                'notif_type' => Constant::NOTIF_LIMPAH,
            ];
            notificationMany($reqNotifMany, 'admin-kejaksaan', 'LIMPAH PERKARA');

            DB::commit();
            return redirect()->route('data-prapenuntutan-limpah.index')->with(['success' => 'Berhasil upload file ' . $name_file]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function forward($id, $fitur)
    {
        return view('data-pranut-limpah.forward', compact('id', 'fitur'));
    }

    public function updateForwardPengadilan(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'perkara_id' => 'required',
                'file_is_forward' => 'required|array|min:1',
            ],[
                'min' => 'Harap memilih file yang harus di forward'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $list_file_unforward = FilePerkara::select('id')
                ->where('perkara_id', $request->perkara_id)
                ->whereNotIn('id', $request->file_is_forward)
                ->get();

            foreach ($list_file_unforward as $key => $fp) {
                $file_perkara = FilePerkara::find($fp->id);
                $file_perkara->is_forward = 0;
                $file_perkara->updated_by = Auth::user()->id;
                $file_perkara->save();
            }

            $perkara = Perkara::find($request->perkara_id);
            $perkara->updated_by = Auth::user()->id;
            $perkara->status = Constant::LIMPAH;
            $perkara->save();

            $limpah_perkara = LimpahPerkara::where('perkara_id', $perkara->assignPengadilan->perkara_id)->first();
            $limpah_perkara->updated_by = Auth::user()->id;
            $limpah_perkara->save();

            DB::commit();
            return redirect()->route('data-prapenuntutan-limpah.index')->with(['success' => 'Berhasil limpah perkara dan forward ke pengadilan']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }
}
