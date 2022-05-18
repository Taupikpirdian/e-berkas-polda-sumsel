<?php

namespace App\Http\Livewire\Kepolisian\LaporanPerkara;

use App\FilePerkara;
use App\Perkara;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class LaporanPerkaraUpdate extends Component
{
    public $uid = null,
    $user_id, $no_lp, $date_no_lp, $kategori_id, $kategori_bagian_id, $status, $files, $code_id;

    public function mount($selectedLaporanPerkaraId)
    {
        try {
            $this->breadcrumb = "Tambah Laporan Perkara";
            $this->laporanPerkara = null;
            if ($selectedLaporanPerkaraId) {
                $idLaporanPerkara = Crypt::decrypt($selectedLaporanPerkaraId);
                $this->laporanPerkara = Perkara::find($idLaporanPerkara);
                $this->fileLaporanPerkara = FilePerkara::where('perkara_id', $idLaporanPerkara)->get();
                if ($this->laporanPerkara) {
                    $this->breadcrumb = "Edit Laporan Perkara";
                    $this->uid = $this->laporanPerkara->id;
                    $this->no_lp = $this->laporanPerkara->no_lp;
                    $this->date_no_lp = $this->laporanPerkara->date_no_lp;
                    $this->kategori_id = $this->laporanPerkara->kategori_id;
                    $this->kategori_bagian_id = $this->laporanPerkara->kategori_bagian_id;
                    $this->status = $this->laporanPerkara->status;
                }
            }
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function addLaporanPerkara()
    {
        if (!$this->laporanPerkara) {
            $validator = $this->validate([
                'no_lp' => 'required|unique:perkaras,no_lp',
                'date_no_lp' => 'required|date',
                'kategori_id' => 'required|exists:kategoris,id',
                'kategori_bagian_id' => 'required|exists:kategori_bagians,id',
                'status' => 'required',
                'files' => 'required|max:25600',
            ]);

            if (!$validator->fails()) {
                DB::beginTransaction();
                try {
                    $laporanPerkara = Perkara::create([
                        'user_id' => $this->user_id,
                        'no_lp' => $this->no_lp,
                        'date_no_lp' => $this->date_no_lp,
                        'kategori_id' => $this->kategori_id,
                        'kategori_bagian_id' => $this->kategori_bagian_id,
                        'status' => $this->status,
                    ]);

                    if ($laporanPerkara && $files) {
                        foreach ($files as $key => $file) {
                            if ($file) {
                                $ext = $file->getClientOriginalExtension();
                                $codeFile = \App\CodeFile::find($code_id);
                                $name = $codeFile . "-" . $this->no_lp . "-" . \Carbon::now();
                                // save file
                                $upload = $file->storeAs(
                                    'file_perkara',
                                    $name,
                                    'local'
                                );
                                
                                $visibility = Storage::disk('local')->getVisibility('file_perkara/' . $name);
                                Storage::disk('local')->setVisibility('file_perkara/' . $name, 'public');
                                // save db
                                $filePerkara = FilePerkara::create([
                                    'code_id' => $this->code_id,
                                    'perkara_id' => $laporanPerkara->id,
                                    'original_name' => $file->getClientOriginalName(),
                                    'name' => $name,
                                    'type_file' => $ext,
                                ]);
                            }
                        }
                    }

                    DB::commit();
                    $this->emit('laporanPerkaraUpdated', false);
                } catch (Exception $e) {
                    DB::rollBack();
                }
            }
        } else {
            if ($this->laporanPerkara->no_lp != $this->no_lp) {
                $this->validate([
                    'no_lp' => 'required|unique:perkaras,no_lp',
                ]);
            }

            $validator = $this->validate([
                'no_lp' => 'required|unique:perkaras,no_lp',
                'date_no_lp' => 'required|date',
                'kategori_id' => 'required|exists:kategoris,id',
                'kategori_bagian_id' => 'required|exists:kategori_bagians,id',
                'status' => 'required',
                'files' => 'required|max:25600',
            ]);

            if (!$validator->fails()) {
                DB::beginTransaction();
                try {
                    $this->laporanPerkara->user_id = $this->user_id;
                    $this->laporanPerkara->no_lp = $this->no_lp;
                    $this->laporanPerkara->date_no_lp = $this->date_no_lp;
                    $this->laporanPerkara->kategori_id = $this->kategori_id;
                    $this->laporanPerkara->kategori_bagian_id = $this->kategori_bagian_id;
                    $this->laporanPerkara->status = $this->status;
                    $this->laporanPerkara->save();

                    $this->emit('laporanPerkaraUpdated', true);
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                }
            }
        }

        $this->no_lp = '';
        $this->user_id = '';
        $this->date_no_lp = '';
        $this->kategori_id = '';
        $this->kategori_bagian_id = '';
        $this->status = '';
    }

    public function indexLaporanPerkara()
    {
        $this->emit('indexLaporanPerkara', true);
    }

    public function render()
    {
        $user_pengirim = \Auth::user();

        $user_pengirim_id = Crypt::encrypt($user_pengirim->id);

        $list_kategori = \App\Kategori::all();
        $list_kategori_bagian = \App\KategoriBagian::all();
        $list_code_file = \App\CodeFile::all();

        return view('livewire.kepolisian.laporan-perkara.laporan-perkara-update', compact('user_pengirim', 'list_kategori', 'list_kategori_bagian', 'user_pengirim_id', 'list_code_file'));
    }
}
