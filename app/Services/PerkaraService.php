<?php

namespace App\Services;

use App\User;
use App\Akses;
use App\Perkara;
use App\Constant;
use App\FilePerkara;
use App\AssignPerkara;
use App\AssignPerkaraToOperator;
use App\TersangkaPerkara;
use App\JaksaPenuntutUmum;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\GeneralRepository;

class PerkaraService
{
  public function index($request, $role, $user_id = null, $arrayPerkaraId = [], $filter = null, $kategoriBagianId = null)
  {
    $arrKategoriBagianId = [];
    // filter
    $freeTextSearch = isset($request['query']) ? $request['query'] : null;
    $querySpdp = isset($request['query_spdp']) ? $request['query_spdp'] : null;
    $queryTersangka = isset($request['query_tersangka']) ? $request['query_tersangka'] : null;
    $queryJpu = isset($request['query_jpu']) ? $request['query_jpu'] : null;
    $queryPenyidik = isset($request['query_penyidik']) ? $request['query_penyidik'] : null;
    $statusData = isset($request['status']) ? $request['status'] : null;
    $date = null;
    if (isset($request['query_daterange'])) {
      if ($request['query_daterange']) {
        $date = (new GeneralRepository())->customDateRange($request['query_daterange']);
      }
    }

    if ($role == 'admin-kejaksaan') {
      $arrKategoriBagianId = wilayahHukumInduk();
    }

    $data = Perkara::with([
      'statusBerkas',
      'fileSpdp',
      'fileSpdpFirst',
      'fileSpdpSplit.tersangka',
      'fileSprintSidik',
      'fileSprintTugas',
      'fileBa',
      'fileP16',
      'fileP17',
      'fileP18',
      'fileP19',
      'fileResumeBerkasPerkara',
      'fileP20',
      'fileP21',
      'fileP21A',
      'fileSop02',
      'fileBerkasKembali',
      'fileTahapII',
      'perkaraTersangka',
      'perkaraJaksa.masterJaksa',
      'penyidik',
    ])->when($role == 'kepolisian', function ($q) use ($user_id) {
      $q->where('user_id', $user_id);
    })->when($role == 'admin-kejaksaan', function ($q) use ($arrKategoriBagianId) {
      $q->whereIn('status', [Constant::OPEN, Constant::ON_PROGRESS])
        ->whereIn('kategori_bagian_id', $arrKategoriBagianId);
    })->when($role == 'admin-kepolisian', function ($q) use ($kategoriBagianId) {
      $q->where('kategori_bagian_id', $kategoriBagianId);
    })->when($role == 'kejaksaan', function ($q) use ($arrayPerkaraId) {
      $q->whereIn('id', $arrayPerkaraId);
    })->when($role == 'operator-01' || $role == 'operator-02' || $role == 'operator-03' || $role == 'operator-04' || $role == 'operator-kasi-pidum' || $role == 'operator-kasi-pidsus', function ($q) use ($arrayPerkaraId) {
      $q->whereIn('id', $arrayPerkaraId);
    })->where(function ($query) use ($freeTextSearch) {
      $query->whereHas('fileSpdpFirst', function ($query) use ($freeTextSearch) {
        $query->where('no_berkas', 'like', "%$freeTextSearch%");
      })->orWhereHas('perkaraTersangka', function ($query) use ($freeTextSearch) {
        $query->where('name', 'like', "%$freeTextSearch%");
      })->orWhereHas('fileSpdpSplit', function ($query) use ($freeTextSearch) {
        $query->where('no_berkas', 'like', "%$freeTextSearch%");
      });
    })->when($statusData, function ($q) use ($statusData) {
      $q->where('status', $statusData);
    })->when($date, function ($q) use ($date) {
      $q->whereHas('fileSpdpFirst', function ($query) use ($date) {
        $query->whereBetween('tgl_berkas', [$date['startDate'], $date['endDate']]);
      })->orWhereHas('fileSpdpSplit', function ($query) use ($date) {
        $query->whereBetween('tgl_berkas', [$date['startDate'], $date['endDate']]);
      });
    })->when($querySpdp, function ($q) use ($querySpdp) {
      $q->whereHas('fileSpdpFirst', function ($query) use ($querySpdp) {
        $query->where('no_berkas', 'like', "%$querySpdp%");
      })->orWhereHas('fileSpdpSplit', function ($query) use ($querySpdp) {
        $query->where('no_berkas', 'like', "%$querySpdp%");
      });
    })->when($queryTersangka, function ($q) use ($queryTersangka) {
      $q->whereHas('perkaraTersangka', function ($query) use ($queryTersangka) {
        $query->where('name', 'like', "%$queryTersangka%");
      });
    })->when($queryJpu, function ($q) use ($queryJpu) {
      $q->whereHas('perkaraJaksa.masterJaksa', function ($query) use ($queryJpu) {
        $query->where('name', 'like', "%$queryJpu%");
      });
    })->when($queryPenyidik, function ($q) use ($queryPenyidik) {
      $q->whereHas('penyidik', function ($query) use ($queryPenyidik) {
        $query->where('name', 'like', "%$queryPenyidik%");
      });
    })->when($filter == "spdp", function ($q) {
      $q->has('fileSpdp');
    })->when($filter == "p16", function ($q) {
      $q->has('fileP16');
    })->when($filter == "p17", function ($q) {
      $q->has('fileP17');
    })->when($filter == "p18", function ($q) {
      $q->has('fileP18');
    })->when($filter == "p20", function ($q) {
      $q->has('fileP20');
    })->when($filter == "p21", function ($q) {
      $q->has('fileP21');
    })->when($filter == "p21a", function ($q) {
      $q->has('fileP21A');
    })->when($filter == "berkas", function ($q) {
      $q->has('fileResumeBerkasPerkara');
    })->when($filter == "spdp-kembali", function ($q) {
      $q->has('fileBerkasKembali');
    })->when($filter == "tahap-2", function ($q) {
      $q->has('fileTahapII');
    })->when($filter == "p21", function ($q) {
      $q->has('fileP21');
    })->orderBy('perkaras.updated_at', 'desc');

    return $data;
  }

  public function perkaraById($id)
  {
    $data = Perkara::with([
      'fileSpdp',
      'fileP17',
      'perkaraTersangka',
      'perkaraJaksa.masterJaksa',
      'statusBerkas',
    ])->where('perkaras.id', $id)
      ->first();

    return $data;
  }

  public function noBerkasById($perkara_id, $codeBerkas)
  {
    $data = FilePerkara::where('code_id', $codeBerkas)->where('perkara_id', $perkara_id)->latest()->first();
    return $data ? $data->no_berkas : '';
  }

  public function filePerkaraById($perkara_id, $codeBerkas)
  {
    $data = FilePerkara::where('code_id', $codeBerkas)->where('perkara_id', $perkara_id)->latest()->first();
    if ($data) {
      return [
        'status' => 'existing',
        'id' => $data->id,
        'original_name' => $data->original_name,
        'custom_name' => $data->name,
      ];
    }

    return false;
  }

  public function dataTersangka($perkara_id)
  {
    return TersangkaPerkara::orderBy('id', 'asc')->where('perkara_id', $perkara_id)->get();
  }

  public function getJaksa()
  {
    $data = JaksaPenuntutUmum::where('user_id', '!=', null)->get();
    return $data;
  }

  public function listUserJaksa($kategoriBagianId)
  {
    $datas = User::with([
      'jpu',
      'aksesFirst',
    ])->whereHas('aksesFirst', function ($q) use ($kategoriBagianId) {
      $q->where('kategori_bagian_id', $kategoriBagianId);
    })->role('kejaksaan')->has('jpu')->orderBy('name', 'asc')->get();

    return $datas;
  }

  public function listUserOperator($kategoriBagianId)
  {
    $arrRole = [
      'operator-kasi-pidum',
      'operator-kasi-pidsus',
      'operator-01',
      'operator-02',
      'operator-03',
      'operator-04',
    ];

    $datas = User::with([
      'aksesFirst',
      'roles'
    ])->whereHas('aksesFirst', function ($q) use ($kategoriBagianId) {
      $q->where('kategori_bagian_id', $kategoriBagianId);
    })->whereHas("roles", function ($q) use ($arrRole) {
      $q->whereIn("name", $arrRole);
    })->orderBy('name', 'asc')
      ->get();

    return $datas;
  }

  public function getPerkaraIdFromAssignPerkara($jaksa_penuntut_umum_id)
  {
    return AssignPerkara::where('jaksa_penuntut_umum_id', $jaksa_penuntut_umum_id)->pluck('perkara_id')->toArray();
  }

  public function getPerkaraIdFromAssignOperator($user_id)
  {
    return AssignPerkaraToOperator::where('user_id', $user_id)->pluck('perkara_id')->toArray();
  }
}
