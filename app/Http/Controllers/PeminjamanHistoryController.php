<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;

use Auth;
use View;
use PDF;

use Session;
use App\User;
use App\PeminjamanMaster;

use App\PeminjamanPengecekanHistory;

class PeminjamanHistoryController extends Controller
{
    public function index()
    {
        $this->authorize('bukutanah.read');
        return view('peminjaman.peminjamanhistory.index');
    }

    public function apiPeminjamanHistory()
    {
        $this->authorize('bukutanah.read');
        $data = PeminjamanPengecekanHistory::all();

        return Datatables::of($data)->make(true);
            // ->addColumn('action', function ($data) {
            //     return '<a id="cekpinjam" data-value="' . $data->status_pinjam . '" data-id="' . $data->id . '" class="btn btn-warning">
            //                     <i class="fa fa-rocket"></i> 
            //                 </a>';
            // })->rawColumns(['action'])->make(true);

    }
    public function cetak(Request $request)
    {
        $this->authorize('bukutanah.read');
        $datetime = \Carbon::now();
        $replace = array(" ", ":");
        $datetime = str_replace($replace, '-', $datetime);

        $tahun =  $request->tahun;
        $bulan =  $request->bulan;

        $data = PeminjamanPengecekanHistory::whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->get();
        $data = [
            'data' => $data,
            'tahun' => $tahun,
            'bulan' => $bulan,
        ];
        // return $data;


        $pdf = PDF::loadView('peminjaman.peminjamanhistory.cetak', $data);
        $pdf->save(storage_path() . '/app/pdf/cetakpeminjamanhistory' . $datetime . '.pdf');
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    // public function cekpinjam(Request $request)
    // {

    //     $data = PeminjamanPengecekan::find($request->id);
    //     $data->status_pinjam = 0;
    //     $data->update();

    //     Session::flash('info', 'Data Telah Dikembalikan Kesemula');
    //     return View::make('layouts/alerts');

    // }
}
