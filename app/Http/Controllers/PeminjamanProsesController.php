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
use App\PeminjamanMaster;
use App\PeminjamanDetail;

class PeminjamanProsesController extends Controller
{
   
    public function index()
    {
        return view('peminjaman.peminjamanproses.index');
    }

    public function store(Request $request)
    {
       
        Peminjaman::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'unit_kerja' => $request->unit_kerja,
            'kegiatan' => $request->kegiatan,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'created_by' => auth()->user()->id,
            'kd_kantor' => auth()->user()->kd_kantor,
        ]);
        $peminjamanid = DB::getPdo()->lastInsertId();

        if ($request->idbukutanah != null){
            $datas = [];
            for($i = 0; $i < count($request->idbukutanah); $i++){
                $datas = [
                    'peminjaman_id' => $peminjamanid,
                    'idbukutanah' => $request->idbukutanah[$i],
                    'no_hak' => $request->no_hak[$i],
                    'jenis_hak' => $request->jenis_hak[$i],
                    'desa' => $request->desa[$i],
                    'kecamatan' => $request->kecamatan[$i],
                ];

                PeminjamanDetail::insert($datas);
            }
        }

        return redirect()->back()->with('success','Data Berhasil Disimpan');

        

    }

   
    public function show($id)
    {
        return PeminjamanDetail::where('peminjaman_id',$id)->get();
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
        Peminjaman::destroy($id);

        Session::flash('info', 'Data Berhasil Dihapus');
        return View::make('layouts/alerts');
    }

    public function destroydetail($id)
    {
        PeminjamanDetail::destroy($id);

    }
    public function autoComplete(Request $request)
    {
        $query = $request->get('term','');

        $data=PeminjamanMaster::where('idbukutanah','LIKE','%'.$query.'%')->limit(20)->get();
        $datas=array();


        foreach ($data as $d) {
            $datas[] = array('idbukutanah'=>$d->idbukutanah.' || Jenis Hak: '.$d->jenis_hak.' || No Hak: '.$d->no_hak. ' || Desa: '.$d->desa.' || Kec: '.$d->kecamatan, 'id'=>$d->idbukutanah);
        }

        if (count($datas)) {
            return $datas;
        } else {
            return ['idbukutanah'=>'Data yang anda cari tidak ada','id'=>'Data yang anda cari tidak ada'];
        }
    }

    public function showData(Request $request)
    {
        $id =  $request->idbukutanah;

        $datas=PeminjamanMaster::where('idbukutanah', $id)->first();
        

        $data= array(
            'idbukutanah'=>$datas->idbukutanah,
            'kecamatan'=>$datas->kecamatan,
            'desa'=>$datas->desa,
            'jenis_hak'=>$datas->jenis_hak,
            'no_hak'=>$datas->no_hak,
        );
        $row_set[]              =$data;
        return $return = json_encode($row_set);
    }

    public function apiPeminjamanProses()
    {
        $data = Peminjaman::where('kd_kantor',auth()->user()->kd_kantor)->orderBy('updated_at','desc')->get();

        return Datatables::of($data)
            ->addColumn('action',function($data){
                return ' <a href="cetak/peminjamanproses/'.$data->id.'"  target="_blank" class ="btn btn-info"><i class="fa fa-print">
                        </i> </a>' .
                        ' <a id="detailData" data-id="'.$data->id .'" data-nama="'.$data->nama .'" class ="btn btn-warning"><i class="fa fa-eye">
                        </i> </a>' .
                        ' <a id="detailData" data-id="'.$data->id .'" data-nama="'.$data->nama .'" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                        </i> </a>' .
                        ' <a onclick="deleteData('.$data->id .')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i> </a>';
            })->rawColumns(['action'])->make(true);
    }

    public function cetak($id)
    {
        $datetime = Carbon::now();
        $replace = array(" ",":");
        $datetime = str_replace($replace, '-', $datetime);

        $data = Peminjaman::with('peminjamandetail')->find($id);

        $data = ['data'=>$data];
        $pdf = PDF::loadView('peminjaman.peminjamanproses.cetak',$data);
        $pdf->save(storage_path().'/app/pdf/cetakpeminjamanproses'.$datetime.'.pdf');
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();

        // $view = view('peminjaman.peminjamanproses.cetak', $data)->render();

        // $pdf = resolve('dompdf.wrapper');
        // $pdf->loadHTML($view);
        
        //savedata
        // $pdf->save(storage_path().'/app/pdf/cetakpeminjamanproses'.$datetime.'.pdf'); 

        // return $pdf->stream('PDF');

       
    }
}
