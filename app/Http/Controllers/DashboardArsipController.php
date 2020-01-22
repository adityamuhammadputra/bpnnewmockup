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
use Illuminate\Support\Facades\DB;

class DashboardArsipController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Kelompok::with('pengecekan')->get();

        $collection = Pengecekan::all()->sort();

        $grouped = $collection->groupBy(function ($item, $key) {
            return $item['kecamatan'];
        });


        $data2 = $grouped->map(function ($item, $key) use ($collection) {
            return collect($item)->count();
        });

        $foto = Penyerahan::where('foto', 'NOT LIKE', '%app/public/default.png%')
            ->limit(9)
            ->orderBy('id', 'DESC');
        $slider_pernyerahan = $foto->pluck('nama1', 'foto');
        $default_foto = $foto->get()[0];

        $tab2 = (object) [
            'slider_pernyerahan' => $slider_pernyerahan,
            'default_foto' => $default_foto,
        ];

        $penyerahans = Penyerahan::with('kegiatan')
            ->select('kegiatan_id', DB::raw('count(kegiatan_id) as total'))
            ->groupBy('kegiatan_id')
            ->get();
        $label = "'" . $penyerahans->pluck('kegiatan')->pluck('nama_kegiatan')->implode("','") . "'";
        $data = $penyerahans->pluck('total')->implode(',');

        $tab3 = (object) [
            'label' => $label,
            'data' => $data,
        ];


        return view('dashboardarsip', compact('data', 'data2', 'tab2', 'tab3'));
    }
}
