<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Auth;
use View;
use Session;
use App\User;
use App\PeminjamanMaster;

use App\PeminjamanPengecekan;
use App\PeminjamanPengecekanHistory;

class PeminjamanMasterWallboardController extends Controller
{
    public function index()
    {
        $this->authorize('bukutanah.read');
        return view('peminjaman.peminjamanwarlboard.index');
    }

    public function apiPeinjamanMasterWarllboard()
    {
        $this->authorize('bukutanah.read');
        $data = PeminjamanPengecekan::where('status_pinjam', 1)->orderBy('updated_at', 'asc');

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a id="cekpinjam" data-value="' . $data->status_pinjam . '" data-id="' . $data->id . '" class="btn btn-warning">
                                <i class="fa fa-rocket"></i> 
                            </a>';
            })->rawColumns(['action'])->make(true);

    }
    public function cekpinjam(Request $request)
    {
        $this->authorize('bukutanah.crud');
        // return $request->all();
        $data = PeminjamanPengecekan::find($request->id);
        $data->status_pinjam = 0;
        $data->update();

        $datas = PeminjamanPengecekan::select('idbukutanah', 'jenis_hak', 'kecamatan','desa', 'no_box', 'jenis_hak', 'no_hak', 'ruang', 'rak', 'baris')->find($request->id)->toArray();
        PeminjamanPengecekanHistory::insert([$datas]);

        Session::flash('info', 'Data telah dikirim ke peminjaman history');
        return View::make('layouts/alerts');

    }
}

   


