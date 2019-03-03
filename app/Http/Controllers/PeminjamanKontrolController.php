<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;


use App\Peminjaman;
use App\PeminjamanDetail;


class PeminjamanKontrolController extends Controller
{
    public function index()
    {
        $this->authorize('peminjamankegiatan.read', 'peminjamanproses.read');
        return view('peminjaman.peminjamankontrol.index');
    }

    public function apiData()
    {
        $this->authorize('peminjamankegiatan.read', 'peminjamanproses.read');
        $data = PeminjamanDetail::with('peminjamanheader');
        // return $data;
        return Datatables::of($data)->make(true);
    }
}
