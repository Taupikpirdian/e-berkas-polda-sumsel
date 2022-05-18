<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpdpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return  [
            'no_lp'           => 'required|unique:perkaras,no_lp',
            'jns_pidana_id'   => 'required',
            'kronologi'       => 'required',
            'penyidik'        => 'required',
            'nrp'             => 'required',
            'no_hp'           => 'required',
            'date_no_lp'      => 'required',
            'nama_tersangka'  => 'required',
            'tempat_lahir'    => 'required',
            'tanggal_lahir'   => 'required',
            'jenis_kelamin'   => 'required',
            'kebangsaan'      => 'required',
            'alamat'          => 'required',
            'agama'           => 'required',
            'pekerjaan'       => 'required',
            'pendidikan'      => 'required',
            'pasal'           => 'required',
            'file_spdp'       => 'required',
            'sprint_sidik'    => 'required',
            'sprint_tugas'    => 'required',
            'file_ba'         => 'required',
            'no_berkas_spdp'  => 'required',
            'no_berkas_sidik' => 'required',
            'no_berkas_tugas' => 'required',
            'no_berita_acara' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'no_lp.unique'             => 'No LP sudah diajukan',
            'no_lp.required'           => 'Form tidak boleh kosong',
            'jns_pidana_id.required'   => 'Form tidak boleh kosong',
            'kronologi.required'       => 'Form tidak boleh kosong',
            'penyidik.required'        => 'Form tidak boleh kosong',
            'nrp.required'             => 'Form tidak boleh kosong',
            'no_hp.required'           => 'Form tidak boleh kosong',
            'date_no_lp.required'      => 'Form tidak boleh kosong',
            'nama_tersangka.required'  => 'Form tidak boleh kosong',
            'tempat_lahir.required'    => 'Form tidak boleh kosong',
            'tanggal_lahir.required'   => 'Form tidak boleh kosong',
            'jk.required'              => 'Form tidak boleh kosong',
            'kebangsaan.required'      => 'Form tidak boleh kosong',
            'alamat.required'          => 'Form tidak boleh kosong',
            'agama.required'           => 'Form tidak boleh kosong',
            'pekerjaan.required'       => 'Form tidak boleh kosong',
            'pendidikan.required'      => 'Form tidak boleh kosong',
            'pasal.required'           => 'Form tidak boleh kosong',
            'file_spdp.required'       => 'Form tidak boleh kosong',
            'sprint_sidik.required'    => 'Form tidak boleh kosong',
            'sprint_tugas.required'    => 'Form tidak boleh kosong',
            'file_ba.required'         => 'Form tidak boleh kosong',
            'no_berkas_spdp.required'  => 'Form tidak boleh kosong',
            'no_berkas_sidik.required' => 'Form tidak boleh kosong',
            'no_berkas_tugas.required' => 'Form tidak boleh kosong',
            'no_berita_acara.required' => 'Form tidak boleh kosong'
        ];
    }
}
