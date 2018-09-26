<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;

use Auth;
use View;
use Session;
use App\User;
use App\PeminjamanMaster;

class PeminjamanHistoryController extends Controller
{
    public function index()
    {
        return view('peminjaman.peminjamanhistory.index');
    }

    public function apiPeminjamanHistory()
    {
        $data = PeminjamanMaster::where('status_pinjam', 2)->orderBy('updated_at', 'asc');

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
        $data->status_pinjam = 0;
        $data->update();

        Session::flash('info', 'Data Telah Dikembalikan Kesemula');
        return View::make('layouts/alerts');

    }
}
