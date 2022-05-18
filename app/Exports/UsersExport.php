<?php

namespace App\Exports;

use App\Constant;
use App\KategoriBagian;
use App\KategoriBagianTurunan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
  public function view(): View
  {
    $poldaList = KategoriBagian::with([
      'tipeLembaga',
      'akses.user',
    ])->where('tipe_lembaga_id',  Constant::POLDA)
      ->get();

    $polresList = KategoriBagian::with([
      'tipeLembaga',
      'akses.user',
    ])->where('tipe_lembaga_id',  Constant::POLRES)
      ->get();

    $kategoriBagianTurunans = KategoriBagianTurunan::with([
      'turunanKategoriBagian.tipeLembaga',
      'turunanKategoriBagian.akses.user',
    ])->where('tipe_turunan', Constant::TURUNAN_POLRES)
      ->get();

    $kejati = KategoriBagian::with([
      'tipeLembaga',
      'akses.user',
    ])->where('tipe_lembaga_id',  Constant::KEJATI)
      ->get();

    $kejari = KategoriBagian::with([
      'tipeLembaga',
      'akses.user',
    ])->where('tipe_lembaga_id',  Constant::KEJARI)
      ->get();

    $userPT = KategoriBagian::with([
      'tipeLembaga',
      'akses.user',
    ])->where('tipe_lembaga_id',  Constant::PT)
      ->get();

    $userPN = KategoriBagian::with([
      'tipeLembaga',
      'akses.user',
    ])->where('tipe_lembaga_id',  Constant::PN)
      ->get();

    return view('exports.users', [
      'poldaList' => $poldaList,
      'polresList' => $polresList,
      'kategoriBagianTurunans' => $kategoriBagianTurunans,
      'kejati' => $kejati,
      'kejari' => $kejari,
      'userPT' => $userPT,
      'userPN' => $userPN,
    ]);
  }
}
