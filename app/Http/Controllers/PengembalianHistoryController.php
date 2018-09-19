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

class PengembalianHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengembalian.pengembalianhistory.index');
    }

    public function apiPengembalianHistory()
    {
        $data = PeminjamanDetail::with('peminjamanheader')->where('status_detail', 1);

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                if ($data->status_detail == 1) {
                    return '<a id="cekdetail" data-value="' . $data->status_detail . '" data-peminjaman_id="' . $data->peminjaman_id . '" data-id="' . $data->id . '" class="btn btn-success btn-sm">
                        <i class="fa fa-check-square-o"></i> 
                    </a> ' .
                        '<a id="detailData" data-id="' . $data->id . '" data-idbukutanah="' . $data->idbukutanah . '" data-no_hak="' . $data->no_hak . '" data-jenis_hak="' . $data->jenis_hak . '" 
                        data-desa="' . $data->desa . '" data-kecamatan="' . $data->kecamatan . '" data-no_warkah="' . $data->no_warkah . '" data-nama="' . $data->peminjamanheader->nama . '"
                        class ="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o">
                    </i> </a>';
                } else {
                    return '<a id="cekdetail" data-value="' . $data->status_detail . '" data-peminjaman_id="' . $data->peminjaman_id . '" data-id="' . $data->id . '" class="btn btn-warning btn-sm">
                        <i class="fa fa-window-close-o"></i> 
                    </a> ' .
                        '<a id="detailData" data-id="' . $data->id . '" data-idbukutanah="' . $data->idbukutanah . '" data-no_hak="' . $data->no_hak . '" data-jenis_hak="' . $data->jenis_hak . '" 
                        data-desa="' . $data->desa . '" data-kecamatan="' . $data->kecamatan . '" data-no_warkah="' . $data->no_warkah . '" data-nama="' . $data->peminjamanheader->nama . '"
                        class ="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o">
                    </i> </a>';
                }
            })->rawColumns(['action'])->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}