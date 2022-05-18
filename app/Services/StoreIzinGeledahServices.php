<?php

namespace App\Services;

use App\Constant;
use App\IzinGeledah;
use App\FileIzinGeledah;
use App\Akses;
use App\KategoriBagian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreIzinGeledahServices
{
    /**
     * semua data yang berstatus progress
     */
    public function store($request, $user_id)
    {
        /**
         * list data untuk kepolisian
         * memunculkan data milik polisi tersebut
         */
        $request->validate(
            [
              'no_lp'           => 'required|unique:perkaras,no_lp',
              'date_no_lp'      => 'required|date',
              'fitur'           => 'required',
              'penyidik'        => 'required',
              'nrp'             => 'required',
              'no_hp'           => 'required',
            ],
            [
              'no_lp.unique'             => 'No LP sudah diajukan',
              'no_lp.required'           => 'Data tidak boleh kosong',
              'date_no_lp.required'      => 'Data tidak boleh kosong',
              'fitur.required'           => 'Fitur tidak boleh kosong',
              'penyidik.required'        => 'Penyidik tidak boleh kosong',
              'nrp.required'             => 'NRP tidak boleh kosong',
              'no_hp.required'           => 'No Hp tidak boleh kosong',
            ]
        );


        DB::beginTransaction();
        try {
            // get kategori_bagian_id
            $akses = Akses::where('user_id', $user_id)->first();
            // get kategori_id
            $kategoriBagian = KategoriBagian::where('id', $akses->kategori_bagian_id)->first();

            $data = IzinGeledah::create([
                'user_id'               => $user_id,
                'no_lp'                 => $request->no_lp,
                'penyidik'              => $request->penyidik,
                'nrp'                   => $request->nrp,
                'no_hp'                 => $request->no_hp,
                'date_no_lp'            => date("Y-m-d", strtotime($request->date_no_lp)),
                'kategori_id'           => $kategoriBagian->kategori_id,
                'kategori_bagian_id'    => $akses->kategori_bagian_id,
                'status'                => Constant::ON_PROGRESS,
            ]);
            
            // files
            $surat_permohonan = $request->file('surat_permohonan');
            // save file SURAT_PERMOHONAN
            $this->saveFile($surat_permohonan, Constant::SURAT_PERMOHONAN, $data);

            // files
            $resume_lapju = $request->file('resume_lapju');
            // save file RESUME_LAPJU
            $this->saveFile($resume_lapju, Constant::RESUME_LAPJU, $data);

            // files
            $spdp = $request->file('spdp');
            // save file SPDP
            $this->saveFile($spdp, Constant::SPDP, $data);

            // files
            $penyidikan = $request->file('penyidikan');
            // save file SURAT_PERINTAH_PENYIDIKAN
            $this->saveFile($penyidikan, Constant::SURAT_PERINTAH_PENYIDIKAN, $data);

            // files
            $penyelidikan = $request->file('penyelidikan');
            // save file SURAT_PERINTAH_PENYELIDIKAN
            $this->saveFile($penyelidikan, Constant::SURAT_PERINTAH_PENYELIDIKAN, $data);

            // files
            $penggeledahan = $request->file('penggeledahan');
            // save file SURAT_PERINTAH_PENGGELEDAHAN
            $this->saveFile($penggeledahan, Constant::SURAT_PERINTAH_PENGGELEDAHAN, $data);

            // files
            $ba_penggeledahan = $request->file('ba_penggeledahan');
            // save file BERITA_ACARA_PENGGELEDAHAN
            $this->saveFile($ba_penggeledahan, Constant::BERITA_ACARA_PENGGELEDAHAN, $data);

            // files
            $ba_saksi = $request->file('ba_saksi');
            // save file BERITA_ACARA_KETERANGAN_SAKSI_TERSANGKA
            $this->saveFile($ba_saksi, Constant::BERITA_ACARA_KETERANGAN_SAKSI_TERSANGKA, $data);

            // files
            $surat_penerimaan_barang_bukti = $request->file('surat_penerimaan_barang_bukti');
            // save file SURAT_TANDA_PENERIMAAN_BARANG_BUKTI
            $this->saveFile($surat_penerimaan_barang_bukti, Constant::SURAT_TANDA_PENERIMAAN_BARANG_BUKTI, $data);

            // files
            $laporan_polisi = $request->file('laporan_polisi');
            // save file LAPORAN_POLISI
            $this->saveFile($laporan_polisi, Constant::LAPORAN_POLISI, $data);
            
            // notification
            $text = 'Penerimaan File Izin Geledah dengan no lp '.$request->no_lp;
            $req = [
                'user_id'       => $user_id,
                'desc'          => $text,
                'data_id'       => $data->id,
                'notif_type' => Constant::NOTIF_IZIN_GELEDAH
            ];

            notificationMany($req, 'pengadilan', 'Menerima File Izin Geledah');

            DB::commit();

            $flash_store = 'Berhasil mengajukan izin geledah';
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }

        return $flash_store;
    }

    function saveFile($file, $code_file, $data)
    {
        if ($file) {
            try {
                // file ext
                $ext = $file->getClientOriginalExtension();
                // file type
                $codeFile = $code_file;
                // file name
                $name = $codeFile . "-" . str_replace(' ', '', $data->no_lp) . "-" . date('YmdHis').'.'.$ext;
                // folder
                $folder = 'files/izin-geledah/'.$data->id;
                
                
                Storage::disk('public')->putFileAs($folder, $file, $name);
                // save db file spdp
                FileIzinGeledah::create([
                    'code_id'         => $codeFile,
                    'izin_geledah_id' => $data->id,
                    'original_name'   => $file->getClientOriginalName(),
                    'name'            => $name,
                    'type_file'       => $ext,
                ]);
            } catch (\Throwable $th) {
                dd($th);
            }
        
            return true;
        }else{
          return false;
        }
    }

}
