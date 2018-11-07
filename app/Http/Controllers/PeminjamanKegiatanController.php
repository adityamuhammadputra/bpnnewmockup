<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Form;
use DB;
use PDF;
use Auth;
use View;
use Session;
use Carbon;

use App\User;
use App\Peminjaman;
use App\PeminjamanMaster;
use App\PeminjamanDetail;
use App\Pegawai;
use App\Kegiatan;

class PeminjamanKegiatanController extends Controller
{
   
    public function index()
    {
        $kegiatan = Kegiatan::orderBy('no_urut', 'asc')->pluck('nama_kegiatan', 'id')->toArray();
        $kegiatan = ['' => '---- Pilih Kegiatan ----'] + $kegiatan;

        return view('peminjaman.peminjamankegiatan.index',compact('kegiatan'));
    }

   
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    
    // public function cek(Request $request)
    // {
        
    //     $data = Peminjaman::find($request->id);
    //     $data->status = 2;
    //     $data->update();

    //     PeminjamanDetail::where('peminjaman_id', '=', $request->id)
    //         ->update(['status_detail' => '1']);


    //     Session::flash('info', 'Data Berhasil Dikirim Kepengembalian');
    //     return View::make('layouts/alerts');
          
    // }

    // public function cekdetail(Request $request)
    // {
    //     $checkall = PeminjamanDetail::where('peminjaman_id',$request->peminjaman_id)
    //         ->where('status_detail',0)
    //         ->pluck('status_detail')->count();
    //     if($checkall <= 1){
    //         // return "nol habis";
           
    //         $data = PeminjamanDetail::find($request->id);
    //         $data->status_detail = 1;
    //         $data->tanggal_kembali = Carbon::now();
    //         $data->update();

    //         $datas = Peminjaman::find($request->peminjaman_id);
    //         $datas->status = 2;
    //         $datas->update();

    //     }
    //     else{
    //         // return "nol ada";
    //         $data = PeminjamanDetail::find($request->id);
    //         $data->status_detail = 1;
    //         $data->tanggal_kembali = Carbon::now();
    //         $data->update();
    //     }
        
    //     Session::flash('info', 'Berkas behasil dikembalikan');
    //     return View::make('layouts/alerts');

    // }

    public function store(Request $request)
    {
        $date = Carbon::now();
        $replace = array(" ", ":");
        $datetime = str_replace($replace, '-', $date);
        $datacetak = PeminjamanDetail::with('peminjamanheader')->whereIn('id',$request->data)->get();
        // $user = User::with('pegawai')->find(auth()->user()->id);
        // return $user;
        
        $data = [
            'data' => $datacetak,
            // 'user' => $user
        ];
        // return $data;
        $pdf = PDF::loadView('peminjaman.peminjamankegiatan.cetak', $data);
        $pdf->save(storage_path() . '/app/pdf/cetakpeminjamankegiatan' . $datetime . '.pdf');
        $pdf->setPaper('a4', 'landscape');


        $datas = PeminjamanDetail::whereIn('id', $request->data);


        $datas->update([
            'status_detail' => '3',
            'tanggal_kembali' => $date,
        ]);


        return $pdf->stream();

        

    }

    public function datadetail($id)
    {
        return PeminjamanDetail::find($id);
    }

    public function datadetailupdate(Request $request, $id)
    {
        $data = PeminjamanDetail::find($id);
        $data->idbukutanah = $request['idbukutanah'];
        $data->jenis_hak = $request['jenis_hak'];
        $data->desa = $request['desa'];
        $data->kecamatan = $request['kecamatan'];
        $data->no_hak = $request['no_hak'];
        $data->no_su = $request['no_su'];
        $data->no_warkah = $request['no_warkah'];

        $data->update();

        Session::flash('info', 'Data berhasil Dirubah');
        return View::make('layouts/alerts');
    }

    // public function apiPeminjamanKegiatan()
    // {
    //     $data = Peminjaman::with('kegiatan')->where('kd_kantor', auth()->user()->kd_kantor)->where('status', 1)->orderBy('updated_at', 'desc');
    //     return Datatables::of($data)

    //         ->addColumn('action', function ($data) {
    //             return ' <span class="label label-danger label-borok">' . $data->jumlahpinjamkegiatan . '</span><a id="cek" data-value="' . $data->status . '" data-id="' . $data->id . '" class ="btn btn-warning"><em class="fa fa-rocket">
    //                     </em> </a>' .
    //                 ' <a id="detailData" data-id="' . $data->id . '" data-nama="' . $data->nama . '" data-nip="' . $data->nip . '" data-unitkerja="' . $data->unit_kerja . '" 
    //                         data-kegiatan="' . $data->kegiatan . '" data-tanggalpinjam="' . $data->tanggal_pinjam . '" data-tanggalkembali="' . $data->tanggal_kembali . '" 
    //                          data-via="' . $data->via . '" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
    //                     </i> </a>' ;
    //         })->rawColumns(['action'])->make(true);
    // }
    public function apiPeminjamanKegiatan()
    {
        $data = PeminjamanDetail::with('peminjamanheader')->where('status_detail',1)->whereHas('peminjamanheader',function($q){
            if(auth()->user()->kegiatan_id == 100){

            }
            else{
                $q->where('kegiatan', auth()->user()->kegiatan_id);

            }
        });

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<label class="containers"><a onclick= "datadetail(' . $data->id . ')"
                    class ="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o">
                </i> </a>
                
                <input type="checkbox" name="data[]" value="'.$data->id. '"><span class="checkmark"></span></label>' .
              
                '';
               
            })->rawColumns(['action'])->make(true);

    }

    
   
}
