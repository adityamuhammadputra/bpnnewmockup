<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Auth;
use View;
use Session;
use App\User;
use App\PeminjamanMaster;

class PeminjamanMasterWallboardController extends Controller
{
    public function index()
    {
        return view('peminjaman.peminjamanwarlboard.index');
    }

    public function apiPeinjamanMasterWarllboard()
    {
        $data = PeminjamanMaster::where('status_pinjam', 1)->orderBy('updated_at', 'asc');

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a id="cekpinjam" data-value="' . $data->status_pinjam . '" data-id="' . $data->id . '" class="btn btn-warning">
                                <i class="fa fa-rocket"></i> 
                            </a>';
            })->rawColumns(['action'])->make(true);

    }
    public function cekpinjam(Request $request)
    {

        $data = PeminjamanMaster::find($request->id);
        $data->status_pinjam = 2;
        $data->update();

        Session::flash('info', 'Data Telah Dikirim Ke Bukutanah History');
        return View::make('layouts/alerts');

    }
}

   


