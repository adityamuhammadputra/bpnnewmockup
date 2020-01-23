<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Kelompok;
use App\DataWarkah;
use App\Dashboard;
use App\Pengecekan;
use App\Penyerahan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardArsipController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       
        $penyerahans = Penyerahan::query();
        $tungakan = Penyerahan::where('status', 1)->count();
        $tidak_lengkap = Penyerahan::where('status', 2)->count();
        $selesai = Penyerahan::where('status', 3)->count();
        $tab1 = (object)[
            'tungakan' => $tungakan,
            'tidak_lengkap' => $tidak_lengkap,
            'selesai' => $selesai,
        ];

        $foto = Penyerahan::where('foto', 'NOT LIKE', '%app/public/default.png%')
            ->limit(9)
            ->orderBy('id', 'DESC');
        $slider_pernyerahan = $foto->pluck('nama1', 'foto');
        $default_foto = $foto->get()[0];

        $tab2 = (object) [
            'slider_pernyerahan' => $slider_pernyerahan,
            'default_foto' => $default_foto,
        ];

        $penyerahans = Penyerahan::select('kegiatan_id', DB::raw('count(kegiatan_id) as total'))
            ->groupBy('kegiatan_id')
            ->get();
        $label = "'" . $penyerahans->pluck('kegiatan')->pluck('nama_kegiatan')->implode("','") . "'";
        $data = $penyerahans->pluck('total')->implode(',');

        $tab3 = (object) [
            'label' => $label,
            'data' => $data,
        ];

        $datas = Penyerahan::select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
        ->groupby('month')
        ->pluck('data')->implode(',');
        $tab4 = (object)[
            'data' => $datas,
        ];


        return view('dashboardarsip', compact('tab1', 'tab2', 'tab3','tab4'));
    }
}
