<?php

use Illuminate\Database\Seeder;
use App\CodeFile;

class CodeFileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check_data = CodeFile::where(['id' => 1])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 1;
            $code->code = '001';
            $code->name = 'SPDP';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 2])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 2;
            $code->code = '002';
            $code->name = 'P16';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 3])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 3;
            $code->code = '003';
            $code->name = 'P17';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 4])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 4;
            $code->code = '004';
            $code->name = 'Sprint Sidik';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 5])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 5;
            $code->code = '005';
            $code->name = 'Sprint Tugas';
            $code->save();
        }

        // cek list penggeledahan
        $check_data = CodeFile::where(['id' => 6])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 6;
            $code->code = '006';
            $code->name = 'Surat Permohonan';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 7])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 7;
            $code->code = '007';
            $code->name = 'Resume/Lapju';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 8])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 8;
            $code->code = '008';
            $code->name = 'Surat Perintah Penyidikan';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 9])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 9;
            $code->code = '009';
            $code->name = 'Surat Perintah Penyelidikan';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 10])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 10;
            $code->code = '010';
            $code->name = 'Surat Perintah Penggeledahan';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 11])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 11;
            $code->code = '011';
            $code->name = 'Berita Acara Penggeledahan';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 12])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 12;
            $code->code = '012';
            $code->name = 'Berita Acara Keterangan Saksi/Tersangka';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 13])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 13;
            $code->code = '013';
            $code->name = 'Surat Tanda Penerimaan Barang Bukti';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 14])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 14;
            $code->code = '014';
            $code->name = 'Laporan Polisi';
            $code->save();
        }

        // cek list penyitaan
        $check_data = CodeFile::where(['id' => 15])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 15;
            $code->code = '015';
            $code->name = 'Surat Perintah Penyitaan';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 16])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 16;
            $code->code = '016';
            $code->name = 'Berita Acara Penyitaan';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 17])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 17;
            $code->code = '017';
            $code->name = 'Berita Acara Tahap Penyelidikan';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 18])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 18;
            $code->code = '018';
            $code->name = 'Resume Berkas Perkara';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 19])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 19;
            $code->code = '019';
            $code->name = 'P18';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 20])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 20;
            $code->code = '020';
            $code->name = 'P20';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 21])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 21;
            $code->code = '021';
            $code->name = 'P21';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 22])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 22;
            $code->code = '021A';
            $code->name = 'P21A';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 23])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 23;
            $code->code = 'P19';
            $code->name = 'P19';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 24])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 24;
            $code->code = 'SOP-02';
            $code->name = 'SOP Form 02';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 25])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 25;
            $code->code = 'SOP-03';
            $code->name = 'Berkas Kembali';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 26])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 26;
            $code->code = 'T-II';
            $code->name = 'Tahap II';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 27])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 27;
            $code->code = 'RJ/SP3';
            $code->name = 'PENGHENTIAN PERKARA';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 28])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 28;
            $code->code = '031';
            $code->name = 'p31';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 29])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 29;
            $code->code = '033';
            $code->name = 'p33';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 30])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 30;
            $code->code = '034';
            $code->name = 'P34';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 31])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 31;
            $code->code = 'RENDAK';
            $code->name = 'Rendak';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 32])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 32;
            $code->code = 'LP';
            $code->name = 'File LP';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 33])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 33;
            $code->code = 'PTII';
            $code->name = 'Surat Pengantar Tahap II';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 34])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 34;
            $code->code = 'SPHAN';
            $code->name = 'SPHAN';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 35])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 35;
            $code->code = 'BAHAN';
            $code->name = 'BAHAN';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 36])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 36;
            $code->code = 'SPKAP';
            $code->name = 'SPKAP';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 37])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 37;
            $code->code = 'BAKAP';
            $code->name = 'BAKAP';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 38])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 38;
            $code->code = 'KTP/KK';
            $code->name = 'FC KTP/KK';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 39])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 39;
            $code->code = 'SP_SITA';
            $code->name = 'BERKAS SP SITA';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 40])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 40;
            $code->code = 'BA_SITA';
            $code->name = 'BERKAS BA SITA';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 41])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 41;
            $code->code = 'BA_CC';
            $code->name = 'BERKAS BA CC';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 42])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 42;
            $code->code = 'RESUME';
            $code->name = 'BERKAS RESUME';
            $code->save();
        }

        $check_data = CodeFile::where(['id' => 99])->first();
        if (!$check_data) {
            $code = new CodeFile();
            $code->id = 99;
            $code->code = '099';
            $code->name = 'Lainnya';
            $code->save();
        }
    }
}
