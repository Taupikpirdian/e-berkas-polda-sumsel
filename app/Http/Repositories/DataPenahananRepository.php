<?php

namespace App\Http\Repositories;

use App\AssignDataPenahanan;
use App\AssignPerkara;
use App\Constant;
use App\DataPenahanan;
use App\FilePenahanan;
use App\KategoriBagian;
use App\TersangkaPenahanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DataPenahananRepository
{
    public function listDataPenahananAnak($search_query, $fitur)
    {
        $data = DataPenahanan::with(array('tersangka', 'fileDataPenahananPengaju', 'fileDataPenahananBalasan', 'assignDataPenahanan'))->orderBy('created_at', 'desc')->where('type_tersangka', Constant::ANAK);
        $akses;
        foreach(thisAkses() as $key=>$dataakses) {
            $akses[] = $dataakses->kategori_bagian_id;
        }
        if ($search_query) {
            $data->whereHas('tersangka', function ($query) use ($search_query) {
                $query->where('name', 'like', "%$search_query%");
            });
        }

        if($fitur == Constant::KEJAKSAAN_FEATURE){
            $data->where('typebagian_id', Constant::LOOKUP_KEJAKSAAN);
        } elseif ($fitur == Constant::PENGADILAN_FEATURE) {
            $data->where('typebagian_id', Constant::LOOKUP_PENGADILAN);
        }

        if (Auth::user()->hasRole('kepolisian') || Auth::user()->hasRole('kejaksaan')) {
            $data->where('created_by', Auth::user()->id);
        }

        if (Auth::user()->hasRole('pengadilan')) {
            $data->where('pengadilan_id', $akses);
        }
        return $data;
    }

    public function listDataPenahananDewasa($search_query, $fitur)
    {
        $data = DataPenahanan::with(array('tersangka', 'fileDataPenahananPengaju', 'fileDataPenahananBalasan', 'assignDataPenahanan'))
        ->orderBy('created_at', 'desc')
        ->where('type_tersangka', Constant::DEWASA);
        
        $akses;
        foreach(thisAkses() as $key=>$dataakses) {
            $akses[] = $dataakses->kategori_bagian_id;
        }
        if ($search_query) {
            $data->whereHas('tersangka', function ($query) use ($search_query) {
                $query->where('name', 'like', "%$search_query%");
            });
        }

        if($fitur == Constant::KEJAKSAAN_FEATURE){
            $data->where('typebagian_id', Constant::LOOKUP_KEJAKSAAN);
        } elseif ($fitur == Constant::PENGADILAN_FEATURE) {
            $data->where('typebagian_id', Constant::LOOKUP_PENGADILAN);
        }

        if (Auth::user()->hasRole('kepolisian')) {
            $data->where('created_by', Auth::user()->id);
        }

        if (Auth::user()->hasRole('kejaksaan')) {
            $data->where('created_by', Auth::user()->id);
        }

        if (Auth::user()->hasRole('pengadilan')) {
            $data->where('pengadilan_id', $akses);
        }
        return $data;
    }

    public function listDataPenahananById($id)
    {
        $dataPenahanan = DataPenahanan::find($id);
        return $dataPenahanan;
    }

    public function getFileDataPenahananById($id)
    {
        $dataPenahanan = FilePenahanan::where('data_penahanan_id', $id)->get();
        return $dataPenahanan;
    }

    public function getListTersangkaId($id)
    {
        return TersangkaPenahanan::where('datapenahanan_id', $id)->get();
    }

    public function storeDataPenahanan($request, $fitur, $perkara_id)
    {
        $typebagian_id = ($fitur == Constant::KEJAKSAAN_FEATURE) ? Constant::LOOKUP_KEJAKSAAN : Constant::LOOKUP_PENGADILAN;
        return DataPenahanan::create([
            'kategori_id' => $request->kategori_id,
            'kategori_bagian_id' => $request->kategori_bagian_id,
            'perkara_id' => $perkara_id,
            'jenis_penahanan' => $request->jenis_penahanan,
            'type_tersangka' => $request->typepenahanan_id,
            'typebagian_id' => $typebagian_id,
            'status' => Constant::PENGAJU,
            'satuan_kerja' => Auth::user()->id,
            'tanggal_surat_pengajuan' => date("Y-m-d", strtotime($request->tglsurat_pengajuan)),
            'no_surat_pengajuan' => $request->nosurat_pengajuan,
            'waktu_penahanan_habis' => date("Y-m-d", strtotime($request->waktuhabis_penahanan)),
            'jenis_tempat_penahanan' => $request->jenispenahanan_id,
            'tindak_pidana_tersangka' => $request->tindakpidana_tersangka,
            'nomor_surat_perintah_penahanan' => $request->suratperintah_penahanan,
            'nomor_surat_kepanjangan' => $request->suratperpanjangan_kejaksaan,
            'created_by' => Auth::user()->id,
            'catatan' => $request->catatan,
        ]);
    }

    public function storeFileDataPenahanan($request, $dataPenahanan)
    {
        $data_file = FilePenahanan::find($dataPenahanan->id);

        if ($data_file) {
            if ($request->file) {
                $folder = 'data_penahanan' . DIRECTORY_SEPARATOR . date('YmdHis');
                $rand = $this->generateRandomString();
                $ext = $request->file->getClientOriginalExtension();
                $name = 'data_penahanan' . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
                // store to storage
                Storage::disk('public')->putFileAs($folder, $request->file, $name);

                $data_file->original_name = $request->file->getClientOriginalName();
                $data_file->name = $name;
                $data_file->type_file = $ext;
                $data_file->path = $folder . DIRECTORY_SEPARATOR . $name;
                $data_file->save();
            }
        } else {
            $folder = 'data_penahanan' . DIRECTORY_SEPARATOR . date('YmdHis');
            $rand = $this->generateRandomString();
            $ext = $request->file->getClientOriginalExtension();
            $name = 'data_penahanan' . "-" . $rand . "-" . date('YmdHis') . '.' . $ext;
            // store to storage
            Storage::disk('public')->putFileAs($folder, $request->file, $name);

            $data_file = FilePenahanan::create([
                'data_penahanan_id' => $dataPenahanan->id,
                'code' => Constant::PENGAJU,
                'original_name' => $request->file->getClientOriginalName(),
                'name' => $name,
                'type_file' => $ext,
                'path' => $folder . DIRECTORY_SEPARATOR . $name,
            ]);
        }
    }

    public function storeTersangkaDataPenahanan($request, $dataPenahanan)
    {
        return TersangkaPenahanan::create([
            'datapenahanan_id' => $dataPenahanan->id,
            'name' => $request->name,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => date("Y-m-d", strtotime($request->tgl_lahir)),
            'jk' => $request->jk,
            'kebangsaan' => $request->kebangsaan,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'pendidikan' => null,
            'pasal' => null,
        ]);
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function assignDataPenahanan($request, $dataPenahanan, $fitur, $perkara_id)
    {    
        $typebagian_id = ($fitur == Constant::KEJAKSAAN_FEATURE) ? Constant::LOOKUP_KEJAKSAAN : Constant::LOOKUP_PENGADILAN;
        if($fitur == Constant::KEJAKSAAN_FEATURE) {
            $jaksaData = AssignPerkara::with('masterJaksa')->where('perkara_id', $perkara_id)->get();
            foreach($jaksaData as $jaksa) {
                $data = AssignDataPenahanan::create([
                    'datapenahanan_id' => $dataPenahanan->id,
                    'akses_id' => $jaksa->masterJaksa->id,
                    'name' => $jaksa->masterJaksa->name,
                    'type' => $typebagian_id
                ]);
            }
        } else {
            $dataKategori = KategoriBagian::find($request->pengadilan_id);
            $data = AssignDataPenahanan::create([
                'datapenahanan_id' => $dataPenahanan->id,
                'akses_id' =>$dataKategori->id,
                'name' => $dataKategori->name,
                'type' => $typebagian_id
            ]);
        }

        return $data;
    }

    public function assignDataPenahananById($id)
    {
       return AssignDataPenahanan::where('datapenahanan_id', $id)->get();
    }
}