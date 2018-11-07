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


class PeminjamanTunggakanController extends Controller
{
   
    public function index()
    {
        return view('peminjaman.peminjamantunggakan.index');
    }

    public function apiData()
    {
        $data = PeminjamanDetail::with('peminjamanheader')->where('status_detail',2);
        

        return Datatables::of($data)
            ->addColumn('action', function ($data) {

                return '<a id="cekdetails" data-value="' . $data->id . '" class="btn btn-warning btn-sm">
                    <i class="fa fa-window-close-o"></i> 
                </a> ';
            })->rawColumns(['action'])->make(true);

        // $data = PeminjamanDetail::with('peminjamanheader')->where('status_detail', 2);

        // return Datatables::of($data)
        //     ->addColumn('action', function ($data) {
        //         return '<label class="containers"><a onclick= "datadetail(' . $data->id . ')"
        //             class ="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o">
        //         </i> </a>
                
        //         <input type="checkbox" name="data[]" value="' . $data->id . '"><span class="checkmark"></span></label>' .

        //             '';

        //     })->rawColumns(['action'])->make(true);
    }

    public function tunggakancekdetail(Request $request)
    {
         PeminjamanDetail::where('id', $request->id_detail)
            ->update([
                'status_detail' => '0',
                'status_tunggak' => '0',
            ]);
        Session::flash('info', 'Data Peminjaman dikirim ke peminjaman prosess');
        return View::make('layouts/alerts');

    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
