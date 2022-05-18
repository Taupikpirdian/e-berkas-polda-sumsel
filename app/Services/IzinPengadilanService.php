<?php

namespace App\Services;

use App\IzinPengadilan;
use App\Http\Repositories\GeneralRepository;
use App\JenisPenetapan;
use App\PenggeledahanTerhadap;

class IzinPengadilanService
{
  /**
   * semua data yang berstatus progress
   */
  public function index($request, $fitur, $role, $user_id = null, $arrayPengadilan = null)
  {
    $freeTextSearch = isset($request['query']) ? $request['query'] : null;
    $statusData = isset($request['status']) ? $request['status'] : null;
    $date = null;
    if (isset($request['query_daterange'])) {
      $date = (new GeneralRepository())->customDateRange($request['query_daterange']);
    }

    return IzinPengadilan::with([
      'pihak',
      'filePengajuan',
      'fileBalasan',
      'pengadilan',
      'penggeledahanTerhadap',
      'jenisPenetapan',
    ])->when($role == 'kepolisian' || $role == 'kejaksaan', function ($q) use ($user_id) {
      $q->where('user_id', $user_id);
    })->when($role == 'pengadilan', function ($q) use ($arrayPengadilan) {
      $q->whereIn('pengadilan_id', $arrayPengadilan);
    })->where('jns_izin', $fitur)
      ->where(function ($query) use ($freeTextSearch) {
        $query->whereHas('pihak', function ($query) use ($freeTextSearch) {
          $query->where('name', 'like', "%$freeTextSearch%");
        });
      })->when($date, function ($q) use ($date) {
        $q->whereBetween('created_at', [$date['startDate'], $date['endDate']]);
      })->when($statusData, function ($q) use ($statusData) {
        $q->where('status', $statusData);
      })->when($fitur, function ($q) use ($fitur) {
        $q->where('jns_izin', $fitur);
      })->orderBy('izin_pengadilans.created_at', 'desc');
  }

  public function penggeledahanTerhadap()
  {
    return PenggeledahanTerhadap::orderBy('id', 'asc')->get();
  }

  public function jenisPenetapanByType($type)
  {
    return JenisPenetapan::where('type', $type)->orderBy('id', 'asc')->get();
  }
}
