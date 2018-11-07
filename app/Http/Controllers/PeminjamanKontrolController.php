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
        return view('peminjaman.peminjamankontrol.index');
    }

    public function apiData()
    {
        $data = PeminjamanDetail::with('peminjamanheader');
        // return $data;
        return Datatables::of($data)->make(true);
    }
}
