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
        $id = $request->id;

        PeminjamanDetail::where('id', $id)
          ->update([
              'idbukutanah' => $request->idbukutanah,
              'no_hak' => $request->no_hak,
              'jenis_hak' => $request->jenis_hak,
              'desa' => $request->desa,
              'kecamatan' => $request->kecamatan,
              'no_warkah' => $request->no_warkah,
              'no_su' => $request->no_su,
          ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate');

    }


    
    

    public function cek(Request $request){
        // return $request;

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
        // $checkall = PeminjamanDetail::where('peminjaman_id',$request->peminjaman_id)->pluck('status_detail')->toArray();
        $check = PeminjamanDetail::where('id', '=', $request->id)
            ->first();
        

        if($check->status_detail == 0){
            $data = PeminjamanDetail::find($request->id);
            $data->status_detail = 1;
            $data->tanggal_kembali = Carbon::now();
            $data->update();
           
        } 
        else{
            $data = PeminjamanDetail::find($request->id);
            $data->status_detail = 0;
            $data->tanggal_kembali = '';
            $data->update();
        }
        // if(in_array(1,$checkall)){

        // }
        Session::flash('info', 'Data Berhasil Diubah');
        return View::make('layouts/alerts');

        

    }

    // public function apiPengembalian()
    // {
    //     $data = Peminjaman::with('kegiatan')->where('kd_kantor',auth()->user()->kd_kantor)->orderBy('updated_at','desc');

    //     return Datatables::of($data)
    //         ->addColumn('action',function($data){

    //         if($data->status == 1){
    //             return '<a id="cek" data-value="'.$data->status.'" data-id="'.$data->id.'" class="btn btn-success">
    //                     <i class="fa fa-check-square-o"></i> 
    //                 </a>'.
    //                 '<a id="detailData" data-id="'.$data->id .'" data-nama="'.$data->nama .'" data-nip="'.$data->nip .'" data-unitkerja="'.$data->unit_kerja .'" 
    //                     data-kegiatan="'.$data->kegiatan .'" data-tanggalpinjam="'.$data->tanggal_pinjam .'" data-tanggalkembali="'.$data->tanggal_kembali .'" 
    //                     class ="btn btn-primary"><i class="fa fa-pencil-square-o">
    //                 </i> </a>';
    //         }
    //         else{
    //             return '<a id="cek" data-value="'.$data->status.'" data-id="'.$data->id.'" class="btn btn-warning">
    //                     <i class="fa fa-window-close-o"></i> 
    //                 </a>'.
    //                 ' <a id="detailData" data-id="'.$data->id .'" data-nama="'.$data->nama .'" data-nip="'.$data->nip .'" data-unitkerja="'.$data->unit_kerja .'" 
    //                     data-kegiatan="'.$data->kegiatan .'" data-tanggalpinjam="'.$data->tanggal_pinjam .'" data-tanggalkembali="'.$data->tanggal_kembali .'" 
    //                     class ="btn btn-primary"><i class="fa fa-pencil-square-o">
    //                 </i> </a>';
    //         }
                
    //     })->rawColumns(['action'])->make(true);
    // }
    
    public function apiPengembalianDetail()
    {
        $data = PeminjamanDetail::with('peminjamanheader')->where('status_detail',0);
        // return $data;

        return Datatables::of($data)
        ->addColumn('action',function($data){
            if($data->status_detail == 1){
                return '<a id="cekdetail" data-value="'.$data->status_detail.'" data-peminjaman_id="'.$data->peminjaman_id.'" data-id="'.$data->id.'" class="btn btn-success btn-sm">
                        <i class="fa fa-check-square-o"></i> 
                    </a> '.
                    '<a id="detailData" data-id="'.$data->id .'" data-idbukutanah="'.$data->idbukutanah .'" data-no_hak="'.$data->no_hak .'" data-jenis_hak="'.$data->jenis_hak .'" 
                        data-desa="'.$data->desa .'" data-kecamatan="'.$data->kecamatan .'" data-no_warkah="'.$data->no_warkah .'" data-nama="'.$data->peminjamanheader->nama .'"
                        class ="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o">
                    </i> </a>';
            }
            else{
                return '<a id="cekdetail" data-value="'.$data->status_detail.'" data-peminjaman_id="'.$data->peminjaman_id.'" data-id="'.$data->id.'" class="btn btn-warning btn-sm">
                        <i class="fa fa-window-close-o"></i> 
                    </a> '.
                    '<a id="detailData" data-id="'.$data->id .'" data-idbukutanah="'.$data->idbukutanah .'" data-no_hak="'.$data->no_hak .'" data-jenis_hak="'.$data->jenis_hak .'" 
                        data-desa="'.$data->desa .'" data-kecamatan="'.$data->kecamatan .'" data-no_warkah="'.$data->no_warkah .'" data-nama="'.$data->peminjamanheader->nama .'"
                        class ="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o">
                    </i> </a>';
            }
        })->rawColumns(['action'])->make(true);

    }
}
