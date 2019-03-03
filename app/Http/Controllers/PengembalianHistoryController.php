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
        $this->authorize('pengembalian.read');
        return view('pengembalian.pengembalianhistory.index');
    }

    public function apiPengembalianHistory()
    {
        $this->authorize('pengembalian.read');
        $data = PeminjamanDetail::with('peminjamanheader')->where('status_detail', 4);

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
            return '<a id="cekdetail" data-value="' . $data->status_detail . '" data-peminjaman_id="' . $data->peminjaman_id . '" data-id="' . $data->id . '" class="btn btn-warning btn-sm">
                <i class="fa fa-reply"></i> 
            </a> ' ;
            })->rawColumns(['action'])->make(true);

    }

    public function cekdetail(Request $request)
    {
        $this->authorize('pengembalian.read');
        PeminjamanDetail::where('id', '=', $request->id)
            ->update(['status_detail' => '3']);

        Session::flash('info', 'Data Berhasil Dikembalikan Ke Pengembalian Proses');
        return View::make('layouts/alerts');

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
