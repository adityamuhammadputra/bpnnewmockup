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

class PengembalianController extends Controller
{
   
    public function index()
    {
        return view('pengembalian.index');
    }
    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

   
    public function edit($id)
    {
    }

   
    public function update(Request $request, $id)
    {
    }

    
    public function destroy($id)
    {
        //
    }

    public function cek(Request $request){
        $check = Peminjaman::where('id', '=', $request->id)
        // ->where('status', '=', $request->status)
        ->first();
        
        if($check->status == 0)
        {
            $data = Peminjaman::find($request->id);
            $data->status = 1;
            $data->update();

            PeminjamanDetail::where('peminjaman_id', '=', $request->id)
                ->update(['status_detail' => '1']);

            // $datas = PeminjamanDetail::where('peminjaman_id',$request->id)->get();
            // return $datas;
            // $datas->status_detail = 1;
            // $datas->update();
        }
        else{
            $data = Peminjaman::find($request->id);
            $data->status = 0;
            $data->update();

            PeminjamanDetail::where('peminjaman_id', '=', $request->id)
                ->update(['status_detail' => '0']);

        }
    }

    public function cekdetail(Request $request){
        // return $request->peminjaman_id;
        $checkall = PeminjamanDetail::where('peminjaman_id',$request->peminjaman_id)->pluck('status_detail')->toArray();
        $check = PeminjamanDetail::where('id', '=', $request->id)
            ->where('status_detail', '=', $request->status_detail)
            ->first();

        if(in_array(0,$checkall) && $check->status_detail == 0){
            $data = PeminjamanDetail::find($request->id);
            $data->status_detail = 1;
            $data->update();
            // if($check->status_detail == 0)
            // {
            //    
            // }
            // else{
            //     $data = PeminjamanDetail::find($request->id);
            //     $data->status_detail = 0;
            //     $data->update();
            // }
        } 
        else if(in_array(0,$checkall) && $check->status_detail == 1){
            $data = PeminjamanDetail::find($request->id);
            $data->status_detail = 0;
            $data->update();
        }
        // if(in_array(1,$checkall)){

        // }

        else{
            return "data tidak mengandung 0";

            // $datapeminjaman = Peminjaman::find($request->peminjaman_id);
            // // return $datapeminjaman;
            // $datapeminjaman->status = 1;
            // $datapeminjaman->update();
        }

    }

    public function apiPengembalian()
    {
        $data = Peminjaman::with('kegiatan')->where('kd_kantor',auth()->user()->kd_kantor)->orderBy('updated_at','desc')->get();

        return Datatables::of($data)
            ->addColumn('action',function($data){

            if($data->status == 1){
                return '<a id="cek" data-value="'.$data->status.'" data-id="'.$data->id.'" class="btn btn-success">
                        <i class="fa fa-check-square-o"></i> 
                    </a>'.
                    '<a id="detailData" data-id="'.$data->id .'" data-nama="'.$data->nama .'" data-nip="'.$data->nip .'" data-unitkerja="'.$data->unit_kerja .'" 
                        data-kegiatan="'.$data->kegiatan .'" data-tanggalpinjam="'.$data->tanggal_pinjam .'" data-tanggalkembali="'.$data->tanggal_kembali .'" 
                        class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                    </i> </a>';
            }
            else{
                return '<a id="cek" data-value="'.$data->status.'" data-id="'.$data->id.'" class="btn btn-warning">
                        <i class="fa fa-window-close-o"></i> 
                    </a>'.
                    ' <a id="detailData" data-id="'.$data->id .'" data-nama="'.$data->nama .'" data-nip="'.$data->nip .'" data-unitkerja="'.$data->unit_kerja .'" 
                        data-kegiatan="'.$data->kegiatan .'" data-tanggalpinjam="'.$data->tanggal_pinjam .'" data-tanggalkembali="'.$data->tanggal_kembali .'" 
                        class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                    </i> </a>';
            }
                
        })->rawColumns(['action'])->make(true);
    }
    
    public function apiPengembalianDetail($id)
    {
        $data = PeminjamanDetail::where('peminjaman_id',$id)->orderBy('updated_at','desc')->get();

        return Datatables::of($data)
        ->addColumn('action',function($data){
            if($data->status_detail == 1){
                return '<a id="cekdetail" data-value="'.$data->status_detail.'" data-peminjaman_id="'.$data->peminjaman_id.'" data-id="'.$data->id.'" class="btn btn-success">
                        <i class="fa fa-check-square-o"></i> 
                    </a>';
            }
            else{
                return '<a id="cekdetail" data-value="'.$data->status_detail.'" data-peminjaman_id="'.$data->peminjaman_id.'" data-id="'.$data->id.'" class="btn btn-warning">
                        <i class="fa fa-window-close-o"></i> 
                    </a>';
            }
        })->rawColumns(['action'])->make(true);

    }
}
