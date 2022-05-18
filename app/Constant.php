<?php

namespace App;

class Constant
{
    #Status
    const OPEN = 1;
    const ON_PROGRESS = 2;
    const LENGKAP = 3;
    const TAHAP_II = 4;
    const CLOSE = 5;
    const TAHAP_I = 6;
    const RJ = 7;
    const SP3 = 8;
    const LIMPAH = 9;

    #CodeBerkas
    const SPDP = 1;
    const P16 = 2;
    const P17 = 3;
    const SPRINT_SIDIK = 4;
    const SPRINT_TUGAS = 5;
    const BERITA_ACARA_PENYELIDIKAN = 17;
    const RESUME_BERKAS_PERKARA = 18;
    const P18 = 19;
    const P20 = 20;
    const P21 = 21;
    const P21A = 22;
    const P19 = 23;
    const SOP_02 = 24;
    const BERKAS_KEMBALI = 25;
    const BERKAS_TAHAP_II = 26;
    const PENGHENTIAN_PERKARA = 27;
    const P31 = 28;
    const P33 = 29;
    const P34 = 30;
    const FILE_RENDAK = 31;
    const FILE_LP = 32;
    const PENGANTAR_TAHAP_II = 33;
    const SPHAN = 34;
    const BAHAN = 35;
    const SPKAP = 36;
    const BAKAP = 37;
    const KTP_KK = 38;
    const SP_SITA = 39;
    const BA_SITA = 40;
    const BA_CC = 41;
    const RESUME = 42;
    const FILE_LAINNYA = 99;

    #Diskusi
    const IS_NOT_READ = 0;
    const IS_READ = 1;

    #Notif
    const ICON_ALERT  = 1;
    const NOTIF_ALERT = 1;
    const IS_SHOW     = 1;
    const IS_NOT_SHOW = 0;

    #TypeFIle
    const IS_TEXT  = 'text';
    const IS_FILE  = 'file';

    #fileGeledah
    const SURAT_PERMOHONAN                          = 6;
    const RESUME_LAPJU                              = 7;
    const SURAT_PERINTAH_PENYIDIKAN                 = 8;
    const SURAT_PERINTAH_PENYELIDIKAN               = 9;
    const SURAT_PERINTAH_PENGGELEDAHAN              = 10;
    const BERITA_ACARA_PENGGELEDAHAN                = 11;
    const BERITA_ACARA_KETERANGAN_SAKSI_TERSANGKA   = 12;
    const SURAT_TANDA_PENERIMAAN_BARANG_BUKTI       = 13;
    const LAPORAN_POLISI                            = 14;
    const SURAT_PERINTAH_PENYITAAN                  = 15;
    const BERITA_ACARA_PENYITAAN                    = 16;
    const RESUME_BERKAS_PERKASA                     = 18;

    #Type Kategori Bagian
    const POLDA = 1;
    const POLRES = 2;
    const POLSEK = 3;
    const KEJAKSAAN = 4;
    const KEJATI = 4;
    const KEJARI = 5;
    const PT = 6;
    const PN = 7;
    const LAPAS = 8;
    const DIREKTORAT_POLDA = 9;
    const SATUAN_POLRES = 10;
    const PENGADILAN = 5;
    const KEMENKUMHAM = 6;

    #Type Kategori Bagian Nasional
    const N_MAHKAMAH_AGUNG = 1;
    const N_PENGADILAN = 2;
    const N_KEJAKSAAN = 3;
    const N_KEMENKUMHAM = 4;
    const N_KEPOLISIAN = 5;
    const N_BNN = 6;
    const N_KPK = 7;

    #deadline
    const PERLU_UPLOAD_KEMBALI = 0;
    const SUDAH_UPLOAD = 1;
    const PERLU_RESPONSE = 0;
    const SUDAH_RESPONSE = 1;

    // Type Data Penahanan 
    const ANAK = 1;
    const DEWASA = 2;

    // Type Assign Data Penahanan
    const LOOKUP_KEJAKSAAN = 3;
    const LOOKUP_PENGADILAN = 4;

    // Pengaju 
    const PENGAJU_KEPOLISIAN = 'KEPOLISIAN';
    const PENGAJU_KEJAKSAAN_NEGRI = 'KEJAKSAAN_NEGRI';

    // Jenis Izin Pengadilan
    const IZIN_SITA = "izin-sita";
    const IZIN_GELEDAH = "izin-geledah";

    // DIVERSI 
    const PENGAJU = 1;
    const BALASAN = 2;

    // Izin Pengadilan
    const PENGAJUAN_IZIN_PENGADILAN = "pengajuan";
    const BALASAN_IZIN_PENGADILAN = "balasan";
    const CODE_IZIN_SITA = 'IZN-ST';

    // Perpanjangan Penahanan
    const PERPANJANGAN_PENAHANAN = 'Perpanjangan Penahanan';

    // Lookup 
    const JENIS_PENAHANAN = 'jenis_penahanan';

    // Bacp Tipiring
    const PENGAJUAN_BACP_TIPIRING = 1;
    const BALASAN_BACP_TIPIRING = 2;

    // fitur 
    const PENGADILAN_FEATURE = 'pengadilan';
    const KEJAKSAAN_FEATURE = 'kejaksaan';

    // notif type 
    const NOTIF_PRANUT = 1;
    const NOTIF_PENAHANAN = 2;
    const NOTIF_IZIN_SITA = 3;
    const NOTIF_IZIN_GELEDAH = 4;
    const NOTIF_BACP = 5;
    const NOTIF_LIMPAH = 6;
    const NOTIF_SPLIT = 7;
    const BARANG_BUKTI_NARKOTIKA = 7;

    // Role
    const ROLE_ADMIN_MASTER = 'admin-master';
    const ADMIN_KEPOLISIAN = 'admin-kepolisian';
    const ADMIN_KEJAKSAAN = 'admin-kejaksaan';
    const ROLE_KEPOLISIAN = 'kepolisian';
    const ROLE_KEJAKSAAN = 'kejaksaan';

    // Turunan
    const TURUNAN_POLDA = 'polda';
    const TURUNAN_POLRES = 'polres';

    // Subdit Type
    const SUBDIT_POLRES = 'polres';

    // Type Lembaga 
    const TYPE_LEMBAGA_POLDA = 1;
    const TYPE_LEMBAGA_POLRES = 2;
    const TYPE_LEMBAGA_POLSEK = 3;
    const TYPE_LEMBAGA_KEJAKSAAN_TINGGI = 4;
    const TYPE_LEMBAGA_KEJAKSAAN_NEGERI = 5;
    const TYPE_LEMBAGA_PENGADILAN_TINGGI = 6;
    const TYPE_LEMBAGA_PENGADILAN_NEGERI = 7;
    const TYPE_LEMBAGA_LAPAS = 8;
    const TYPE_LEMBAGA_DIREKTORAT_POLDA = 9;
}
