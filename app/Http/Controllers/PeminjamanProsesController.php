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
use App\Via;

class PeminjamanProsesController extends Controller
{
   
    public function index()
    {
        $this->authorize('peminjamanproses.read');
        $kegiatan = Kegiatan::orderBy('no_urut','asc')->pluck('nama_kegiatan','id')->toArray();
        $kegiatan = ['' => '---- Pilih Kegiatan ----'] + $kegiatan;

        $via = Via::orderBy('nama','asc')->pluck('nama','nama')->toArray();
        // $via = ['' => '---- Pilih Via ----'] + $via;
        

        return view('peminjaman.peminjamanproses.index',compact('kegiatan','via'));

    }

    public function getVia(Request $request)
    {
        $this->authorize('peminjamanproses.crud');
        $via = Via::where('kegiatan_id',$request->peminjaman_id)->pluck('nama','nama');
        return response()->json($via);
    }

    public function store(Request $request)
    {
    //    return $request;
        $this->authorize('peminjamanproses.crud');
        Peminjaman::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'unit_kerja' => $request->unit_kerja,
            'kegiatan' => $request->kegiatan,
            'via' => $request->via,
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
                    'no_warkah' => $request->no_warkah[$i],
                    'no_su' => $request->no_su[$i],
                ];

                PeminjamanDetail::insert($datas);
            }
        }

        return redirect()->back()->with('success','Data Berhasil Disimpan');

    }

   
    public function show($id)
    {
        $this->authorize('peminjamanproses.crud');
        
        return PeminjamanDetail::where('peminjaman_id',$id)->get();
    }

   
    public function edit($id)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
        $this->authorize('peminjamanproses.crud');

        $peminjamanid = $request->id;

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
                    'no_warkah' => $request->no_warkah[$i],
                    'no_su' => $request->no_su[$i],
                ];

                PeminjamanDetail::insert($datas);
            }
        }

        Peminjaman::where('id', $peminjamanid)
          ->update([
              'nama' => $request->nama,
              'nip' => $request->nip,
              'unit_kerja' => $request->unit_kerja,
              'kegiatan' => $request->kegiatan,
              'via' => $request->via,
              'tanggal_pinjam' => $request->tanggal_pinjam,
              'tanggal_kembali' => $request->tanggal_kembali,
          ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate');

    }

   
    public function destroy($id)
    {
        $this->authorize('peminjamanproses.crud');
        Peminjaman::destroy($id);

        Session::flash('info', 'Data Berhasil Dihapus');
        return View::make('layouts/alerts');
    }

    public function destroydetail($id)
    {
        $this->authorize('peminjamanproses.crud');
        PeminjamanDetail::destroy($id);

        Session::flash('info', 'Data Berhasil Dihapus');
        return View::make('layouts/alerts');

    }

    public function roket($id)
    {
        $this->authorize('peminjamanproses.crud');
        PeminjamanDetail::where('peminjaman_id', $id)->where('status_tunggak',0)
            ->update([
                'status_detail' => '1',
            ]);

        Session::flash('info', 'Data Peminjaman Berhasil divalidasi');
        return View::make('layouts/alerts');
    }

    public function roketdetail($id)
    {
        $this->authorize('peminjamanproses.crud');
        PeminjamanDetail::where('id', $id)
            ->update([
                'status_detail' => '2',
                'status_tunggak' => '1'
            ]);
        Session::flash('info', 'Data Peminjaman dikirim ke peminjaman tungggakan');
        return View::make('layouts/alerts');
    }

    public function autoCompletePegawai(Request $request)
    {
        $query = $request->get('term','');

        $dataptsl=Pegawai::where('nip','LIKE','%'.$query.'%')->orWhere('nama','LIKE','%'.$query.'%')->limit(20)->get();
        $data=array();
        foreach ($dataptsl as $d) {
                $data[]=array('value'=>$d->nip.' || nama: '.$d->nama.' || Unit Kerja: '.$d->unit_kerja, 'id'=>$d->nip);
        }
        if (count($data)) {
            return $data;
        } else {
            return ['value'=>'Nama atau NIP tidak ada','id'=>''];
        }
       
    }
    public function autoCompletePegawaiShow(Request $request)
    {   
        $id =  $request->nip;

        $datas=Pegawai::where('nip', $id)->first();
        
        $data= array(
            'nip'=>$datas->nip,
            'nama'=>$datas->nama,
            'unit_kerja'=>$datas->unit_kerja,
            'kegiatan_id'=>$datas->kegiatan_id,
        );
        $row_set[]              =$data;
        return $return = json_encode($row_set);
    }

    public function autoComplete(Request $request)
    {
        $query = $request->get('term','');

        $data=PeminjamanMaster::select('idbukutanah', 'jenis_hak', 'no_hak', 'desa', 'kecamatan')
                ->where('idbukutanah','LIKE','%'.$query.'%')->limit(20)->get();
        $datas=array();

        foreach ($data as $d) {
            $datas[] = array('idbukutanah'=>$d->idbukutanah.' || Jenis Hak: '.$d->jenis_hak.' || No Hak: '.$d->no_hak. ' || Desa: '.$d->desa.' || Kec: '.$d->kecamatan, 'id'=>$d->idbukutanah);
        }

        if (count($datas)) {
            return $datas;
        } else {
            return ['value'=>'Data yang anda cari tidak ada','id'=>'Data yang anda cari tidak ada'];
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
        if(auth()->user()->modul_id == 1){
            $data = Peminjaman::with('kegiatan','peminjamandetail')->whereHas('peminjamandetail', function($q){
                $q->where('status_detail',0);  
            })
           ->orderBy('updated_at', 'desc');
        }
        else {
            $data = Peminjaman::with('kegiatan','peminjamandetail')->whereHas('peminjamandetail', function ($q) {
                $q->where('status_detail', 0);
            })->where('created_by', auth()->user()->id)->orderBy('updated_at', 'desc');
        }
        return Datatables::of($data)
           
            ->addColumn('action',function($data){
                return ' <span class="label label-danger label-borok">' . $data->jumlahpinjam . '</span><a href="#" onclick="cetak('.$data->id.')"  class ="btn btn-info"><em class="fa fa-print">
                        </em> </a>' .
                       ' <a href="#" onclick="roket(' . $data->id . ')"  class ="btn btn-warning"><em class="fa fa-rocket">
                        </em> </a>'.
                        ' <a id="detailData" data-id="'.$data->id .'" data-nama="'.$data->nama .'" data-nip="'.$data->nip .'" data-unitkerja="'.$data->unit_kerja .'" 
                            data-kegiatan="'.$data->kegiatan .'"data-tanggalpinjam="'.$data->tanggal_pinjam .'" data-tanggalkembali="'.$data->tanggal_kembali . '" 
                             data-via="' . $data->via . '" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                        </i> </a>' 
                        // ' <a onclick="deleteData('.$data->id .')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        // </i> </a>'
                        ;
            })->rawColumns(['action'])->make(true);
    }

    public function apiPeminjamanProsesDetail($id)
    {
        $data = PeminjamanDetail::where('peminjaman_id',$id)->where('status_detail',0)->orderBy('created_at','desc');

        return Datatables::of($data)
        ->addColumn('action',function($data){
            return ' <a href="#" onclick="roketDetail(' . $data->id . ')"  class ="btn btn-warning"><em class="fa fa-rocket">
                        </em> </a>' . 
                        ' <a onclick="deleteDetail('.$data->id .')" class ="btn btn-danger"><i class="fa fa-trash-o">
                    </i> </a>';
        })->rawColumns(['action'])->make(true);

    }

    public function cetak($id)
    {
        $datetime = Carbon::now();
        $replace = array(" ",":");
        $datetime = str_replace($replace, '-', $datetime);

        $data = Peminjaman::with('peminjamandetailcetak')->find($id);

        

        $kegiatan = $data->kegiatan()->first();


        $data = [
                'data'=>$data,
                'kegiatan' => $kegiatan
                ];
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
