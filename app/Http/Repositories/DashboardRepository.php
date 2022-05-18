<?php

namespace App\Http\Repositories;

use App\Akses;
use App\Constant;
use App\Diversi;
use App\IzinGeledah;
use App\BpacTipiring;
use App\IzinSita;
use App\Perkara;
use App\FilePerkara;
use App\Notification;
use App\Tahanan;
use App\RumahTahanan;
use App\PerpanjanganPenahanan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardRepository
{
    public function dataChartDashboardAdmin($num_last_month = 12)
    {
        $role = thisRole();
        $user_kategori_bagian_id = thisKategoriBagian() != null ? thisKategoriBagian()->kategoribagian_id : null;

        $data = Perkara::distinct()
            ->whereRaw(DB::raw('created_at > now() - INTERVAL ' . strval($num_last_month) . ' month'))
            ->select(DB::raw('MONTH(created_at) bulan, YEAR(created_at) tahun, count(id) as total'))
            ->when($role == 'admin-kejaksaan', function ($q) use ($user_kategori_bagian_id) {
                $q->whereHas('perkaraAdmin', function ($q) use ($user_kategori_bagian_id) {
                    $q->where('kategori_bagian_id', $user_kategori_bagian_id);
                });
            })->when($role == 'admin-kepolisian', function ($q) use ($user_kategori_bagian_id) {
                $q->where('kategori_bagian_id', $user_kategori_bagian_id);
            })
            ->groupBy(DB::raw('MONTH(created_at), YEAR(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'));

        return $data->get();
    }

    public function getDataNotificationActivity()
    {
        $role = thisRole();
        $user_kategori_bagian_id = thisKategoriBagian() != null ? thisKategoriBagian()->kategoribagian_id : null;

        $data = Notification::with('fromUser', 'toUser', 'perkara')
            ->when($role == 'admin-kejaksaan', function ($q) use ($user_kategori_bagian_id) {
                $q->whereHas('fromUser.akses', function ($q) use ($user_kategori_bagian_id) {
                    $q->where('kategori_bagian_id', $user_kategori_bagian_id);
                })->orWhereHas('toUser.akses', function ($q) use ($user_kategori_bagian_id) {
                    $q->where('kategori_bagian_id', $user_kategori_bagian_id);
                });
            })
            ->orderBy('updated_at', 'desc');

        return $data;
    }

    public function countDataForCard($code_name, $is_last_month = false, $filter = 'default')
    {
        $role = thisRole();
        $user_kategori_bagian_id = thisKategoriBagian() != null ? thisKategoriBagian()->kategoribagian_id : null;

        if (strtolower($filter) == 'spdp kembali') {
            $data = Perkara::whereDoesntHave('fileResumeBerkasPerkara')
                ->when($role == 'admin-kejaksaan', function ($q) use ($user_kategori_bagian_id) {
                    $q->whereHas('perkaraAdmin', function ($q) use ($user_kategori_bagian_id) {
                        $q->where('kategori_bagian_id', $user_kategori_bagian_id);
                    });
                })->when($role == 'admin-kepolisian', function ($q) use ($user_kategori_bagian_id) {
                    $q->where('kategori_bagian_id', $user_kategori_bagian_id);
                });
        } else if (strtolower($filter) == 'proses penelitian') {
            $data = Perkara::whereHas('fileResumeBerkasPerkara')
                ->whereDoesntHave('fileP17')
                ->whereDoesntHave('fileP18')
                ->whereDoesntHave('fileP20')
                ->whereDoesntHave('fileP21')
                ->when($role == 'admin-kejaksaan', function ($q) use ($user_kategori_bagian_id) {
                    $q->whereHas('perkaraAdmin', function ($q) use ($user_kategori_bagian_id) {
                        $q->where('kategori_bagian_id', $user_kategori_bagian_id);
                    });
                })->when($role == 'admin-kepolisian', function ($q) use ($user_kategori_bagian_id) {
                    $q->where('kategori_bagian_id', $user_kategori_bagian_id);
                });
        } else if (strtolower($filter) == 'tahap2') {
            $data = Perkara::with([
                'perkaraAdmin'
            ])->when($role == 'admin-kejaksaan', function ($q) use ($user_kategori_bagian_id) {
                $q->whereHas('perkaraAdmin', function ($q) use ($user_kategori_bagian_id) {
                    $q->where('kategori_bagian_id', $user_kategori_bagian_id);
                });
            })->when($role == 'admin-kepolisian', function ($q) use ($user_kategori_bagian_id) {
                $q->where('kategori_bagian_id', $user_kategori_bagian_id);
            })->where('status', Constant::TAHAP_II);
        } else {
            $data = FilePerkara::whereHas('masterFile', function ($query) use ($code_name) {
                $search = strtolower($code_name);
                $query->whereRaw('lower(name) = (?)', $search);
            })->when($role == 'admin-kejaksaan', function ($q) use ($user_kategori_bagian_id) {
                $q->whereHas('perkara.perkaraAdmin', function ($q) use ($user_kategori_bagian_id) {
                    $q->where('kategori_bagian_id', $user_kategori_bagian_id);
                });
            })->when($role == 'admin-kepolisian', function ($q) use ($user_kategori_bagian_id) {
                $q->whereHas('perkara', function ($q) use ($user_kategori_bagian_id) {
                    $q->where('kategori_bagian_id', $user_kategori_bagian_id);
                });
            });
        }

        if ($is_last_month == true) $data->whereMonth('created_at', '=', Carbon::now()->month);

        return $data->count();
    }

    public function getDataPenanganganPerkaraOlehJaksa()
    {
        $role = thisRole();
        $user_kategori_bagian_id = thisKategoriBagian() != null ? thisKategoriBagian()->kategoribagian_id : null;

        $data = DB::table('jaksa_penuntut_umums')
            ->join('pangkats', 'jaksa_penuntut_umums.pangkat_id', '=', 'pangkats.id')
            ->join('assign_perkaras', 'assign_perkaras.jaksa_penuntut_umum_id', '=', 'jaksa_penuntut_umums.id')
            ->when($role == 'admin-kejaksaan', function ($q) use ($user_kategori_bagian_id) {
                $q->join('akses', 'akses.user_id', '=', 'assign_perkaras.jaksa_penuntut_umum_id')
                    ->where('kategori_bagian_id', $user_kategori_bagian_id);
            })
            ->select('jaksa_penuntut_umums.name AS name', 'pangkats.name AS pangkat', 'jaksa_penuntut_umums.nip', DB::RAW('count(assign_perkaras.jaksa_penuntut_umum_id) AS jumlah'))
            ->groupByRaw('assign_perkaras.jaksa_penuntut_umum_id, jaksa_penuntut_umums.name, pangkats.name, jaksa_penuntut_umums.nip')
            ->orderByRaw('jumlah DESC');

        return $data;
    }

    public function getDataPerkaraByPenangananKepolisian()
    {
        $data = DB::table('kategori_bagians')
            ->join('akses', 'kategori_bagians.id', '=', 'akses.kategori_bagian_id')
            ->join('penyidiks', 'akses.user_id', '=', 'penyidiks.user_id')
            ->join('pangkats', 'penyidiks.pangkat_id', '=', 'pangkats.id')
            ->where('kategori_bagians.kode', '=', findKodeSatker())
            ->whereNotIn('kategori_bagians.tipe_lembaga_id', [Constant::TYPE_LEMBAGA_DIREKTORAT_POLDA, Constant::TYPE_LEMBAGA_POLDA])
            ->join('perkaras', 'perkaras.user_id', '=', 'akses.user_id')
            ->select('kategori_bagians.name AS name', 'pangkats.name AS pangkat', 'penyidiks.nrp', DB::RAW('count(perkaras.user_id) AS jumlah'))
            ->groupByRaw('kategori_bagians.id, kategori_bagians.name, pangkats.name, penyidiks.nrp')
            ->orderByRaw('jumlah DESC');

        return $data;
    }

    public function countDataIzinPenahan($is_last_month = false)
    {
        if ($is_last_month) $data = PerpanjanganPenahanan::whereMonth('created_at', '=', Carbon::now()->month)->count();
        else $data = PerpanjanganPenahanan::count();
        return $data;
    }

    public function countDataPerkara($is_last_month = false)
    {
        $role = thisRole();
        $user_kategori_bagian_id = thisKategoriBagian() != null ? thisKategoriBagian()->kategoribagian_id : null;

        if ($is_last_month) {
            $data = Perkara::with([
                'perkaraAdmin'
            ])->when($role == 'admin-kejaksaan', function ($q) use ($user_kategori_bagian_id) {
                $q->whereHas('perkaraAdmin', function ($q) use ($user_kategori_bagian_id) {
                    $q->where('kategori_bagian_id', $user_kategori_bagian_id);
                });
            })->when($role == 'admin-kepolisian', function ($q) use ($user_kategori_bagian_id) {
                $q->where('kategori_bagian_id', $user_kategori_bagian_id);
            })->whereMonth('created_at', '=', Carbon::now()->month)
                ->count();
        } else {
            $data = Perkara::with([
                'perkaraAdmin'
            ])->when($role == 'admin-kejaksaan', function ($q) use ($user_kategori_bagian_id) {
                $q->whereHas('perkaraAdmin', function ($q) use ($user_kategori_bagian_id) {
                    $q->where('kategori_bagian_id', $user_kategori_bagian_id);
                });
            })->when($role == 'admin-kepolisian', function ($q) use ($user_kategori_bagian_id) {
                $q->where('kategori_bagian_id', $user_kategori_bagian_id);
            })->count();
        }

        return $data;
    }

    public function countDataPranut($role, $user = null)
    {
        $isOperator = false;
        $jaksaId = null;
        $perkaraId = [];

        if ($role == "kejaksaan") {
            // get id jaksa
            $jaksaId = (new KejaksaanRepository)->userJaksaByUserId($user);
            if ($jaksaId) {
                // get list perkara assignee
                $perkaraId = (new KejaksaanRepository)->jaksaAssingPerkaraByJaksaId($jaksaId->id);
            }
        }

        if (
            $role == 'operator-01' ||
            $role == 'operator-02' ||
            $role == 'operator-03' ||
            $role == 'operator-04' ||
            $role == 'operator-kasi-pidum' ||
            $role == 'operator-kasi-pidsus'
        ) {
            // get list perkara assignee
            $perkaraId = (new KejaksaanRepository)->operatorAssingPerkaraByJaksaId($user);
            $isOperator = true;
        }

        $data = Perkara::when($role == 'kepolisian', function ($q) use ($user) {
            $q->where('user_id', $user);
        })->when($role == 'kejaksaan' || $isOperator == true, function ($q) use ($perkaraId) {
            $q->whereIn('id', $perkaraId);
        })->count();

        return $data;
    }

    public function countDataPranutOpen($role, $user = null)
    {
        $data = Perkara::when($role == 'kepolisian', function ($q) use ($user) {
            $q->where('user_id', $user);
        })->where('status', Constant::OPEN)->count();

        return $data;
    }

    public function countDataBpacTipiring($role, $user = null)
    {
        return BpacTipiring::when($role == 'kepolisian', function ($q) use ($user) {
            $q->where('created_by', $user);
        })->count();
    }

    public function countDataTahanan()
    {
        return Tahanan::count();
    }

    public function countDataRumahTahanan()
    {
        return RumahTahanan::count();
    }

    public function countDataDiversi($role, $user = null)
    {
        return Diversi::when($role == 'kepolisian', function ($q) use ($user) {
            $q->where('created_by', $user);
        })->count();
    }

    public function countDataBerkas($role, $user = null)
    {
        $isOperator = false;
        $jaksaId = null;
        $perkaraId = [];

        if ($role == "kejaksaan") {
            // get id jaksa
            $jaksaId = (new KejaksaanRepository)->userJaksaByUserId($user);
            if ($jaksaId) {
                // get list perkara assignee
                $perkaraId = (new KejaksaanRepository)->jaksaAssingPerkaraByJaksaId($jaksaId->id);
            }
        }

        if (
            $role == 'operator-01' ||
            $role == 'operator-02' ||
            $role == 'operator-03' ||
            $role == 'operator-04' ||
            $role == 'operator-kasi-pidum' ||
            $role == 'operator-kasi-pidsus'
        ) {
            // get list perkara assignee
            $perkaraId = (new KejaksaanRepository)->operatorAssingPerkaraByJaksaId($user);
            $isOperator = true;
        }

        $data = Perkara::when($role == 'kepolisian', function ($q) use ($user) {
            $q->where('user_id', $user);
        })->when($role == 'kejaksaan' || $isOperator == true, function ($q) use ($perkaraId) {
            $q->whereIn('id', $perkaraId);
        })->has('fileResumeBerkasPerkara')->count();

        return $data;
    }

    public function countDataBerkasTahapII($role, $user = null)
    {
        $isOperator = false;
        $jaksaId = null;
        $perkaraId = [];

        if ($role == "kejaksaan") {
            // get id jaksa
            $jaksaId = (new KejaksaanRepository)->userJaksaByUserId($user);
            if ($jaksaId) {
                // get list perkara assignee
                $perkaraId = (new KejaksaanRepository)->jaksaAssingPerkaraByJaksaId($jaksaId->id);
            }
        }

        if (
            $role == 'operator-01' ||
            $role == 'operator-02' ||
            $role == 'operator-03' ||
            $role == 'operator-04' ||
            $role == 'operator-kasi-pidum' ||
            $role == 'operator-kasi-pidsus'
        ) {
            // get list perkara assignee
            $perkaraId = (new KejaksaanRepository)->operatorAssingPerkaraByJaksaId($user);
            $isOperator = true;
        }

        $data = Perkara::when($role == 'kepolisian', function ($q) use ($user) {
            $q->where('user_id', $user);
        })->when($role == 'kejaksaan' || $isOperator == true, function ($q) use ($perkaraId) {
            $q->whereIn('id', $perkaraId);
        })->where('status', Constant::TAHAP_II)->count();

        return $data;
    }

    public function countDataSpdpKembali($role, $user = null)
    {
        $jaksaId = null;
        $isOperator = false;
        $perkaraId = [];

        if ($role == "kejaksaan") {
            // get id jaksa
            $jaksaId = (new KejaksaanRepository)->userJaksaByUserId($user);
            if ($jaksaId) {
                // get list perkara assignee
                $perkaraId = (new KejaksaanRepository)->jaksaAssingPerkaraByJaksaId($jaksaId->id);
            }
        }

        if (
            $role == 'operator-01' ||
            $role == 'operator-02' ||
            $role == 'operator-03' ||
            $role == 'operator-04' ||
            $role == 'operator-kasi-pidum' ||
            $role == 'operator-kasi-pidsus'
        ) {
            // get list perkara assignee
            $perkaraId = (new KejaksaanRepository)->operatorAssingPerkaraByJaksaId($user);
            $isOperator = true;
        }

        $data = Perkara::when($role == 'kepolisian', function ($q) use ($user) {
            $q->where('user_id', $user);
        })->when($role == 'kejaksaan' || $isOperator == true, function ($q) use ($perkaraId) {
            $q->whereIn('id', $perkaraId)->doesntHave('fileResumeBerkasPerkara');
        })->count();

        return $data;
    }

    public function countDataP21($role, $user = null)
    {
        $isOperator = false;
        $jaksaId = null;
        $perkaraId = [];

        if ($role == "kejaksaan") {
            // get id jaksa
            $jaksaId = (new KejaksaanRepository)->userJaksaByUserId($user);
            if ($jaksaId) {
                // get list perkara assignee
                $perkaraId = (new KejaksaanRepository)->jaksaAssingPerkaraByJaksaId($jaksaId->id);
            }
        }

        if (
            $role == 'operator-01' ||
            $role == 'operator-02' ||
            $role == 'operator-03' ||
            $role == 'operator-04' ||
            $role == 'operator-kasi-pidum' ||
            $role == 'operator-kasi-pidsus'
        ) {
            // get list perkara assignee
            $perkaraId = (new KejaksaanRepository)->operatorAssingPerkaraByJaksaId($user);
            $isOperator = true;
        }

        $data = Perkara::when($role == 'kepolisian', function ($q) use ($user) {
            $q->where('user_id', $user);
        })->when($role == 'kejaksaan' || $isOperator == true, function ($q) use ($perkaraId) {
            $q->whereIn('id', $perkaraId);
        })->has('fileP21')->count();

        return $data;
    }
}
