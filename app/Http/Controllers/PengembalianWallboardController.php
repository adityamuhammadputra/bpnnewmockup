<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use DB;
use PDF;
use Auth;
use View;
use Session;
use Carbon;

use App\User;
use App\Peminjaman;
use App\PeminjamanDetail;
use App\Pegawai;

class PengembalianWallboardController extends Controller
{

    public function index()
    {
        return view('pengembalian.pengembalianwallboard.index');
    }

    public function apiData()
    {
        $data = PeminjamanDetail::with('peminjamanheader')->where('status_detail','!=',0);
        // return $data;
        return Datatables::of($data)->make(true);
    }


}
