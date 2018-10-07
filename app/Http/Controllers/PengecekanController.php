<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use DB;
use PDF;
use Auth;
use Carbon;
use View;
use Session;

use App\User;
use App\Pengecekan;
use App\DataPtsl;


class PengecekanController extends Controller
{
    public function cetak(Request $request)
    {
        $datetime = Carbon::now();
        $replace = array(" ",":");
        $datetime = str_replace($replace, '-', $datetime);

        $id =  $request->cetak;
        $data = Pengecekan::where('no_box',$id)->get();
        $data = [
            'data'=>$data,
            'id' => $id,
        ];


        $pdf = PDF::loadView('ptsl.pengecekan.cetak',$data);
        $pdf->save(storage_path().'/app/pdf/cetakpengecekanptsl'.$datetime.'.pdf');
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();


    }
    public function apiPengecekan()
    {
        $user_id = auth()->user()->id;
        $kelompok_id = auth()->user()->kelompok_id;
        
        if($user_id == 2){
            $data = Pengecekan::orderBy('created_at','desc');
        }
        else{
            $data = Pengecekan::where('kelompok_id', $kelompok_id)->orderBy('created_at','desc');
        }

        return Datatables::of($data)
            ->addColumn('action',function($data){
                return ' <a onclick="editData('.$data->id .')" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                        </i> </a>' .
                        ' <a onclick="deleteData('.$data->id .')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i> </a>';
            })->rawColumns(['action'])->make(true);
    }
 
    public function index()
    {
        $data = User::with('kelompok')->where('id', auth()->user()->id)->first();
        $kd_kelompok = $data->kelompok->kd_kelompok;

        $kelompok_id = auth()->user()->kelompok_id;
        $maxnb = DB::table('tbl_pengecekan')
            ->select(DB::raw('max(cast(substr(no_box,3) as signed)) as maxnb'))
            ->where('kelompok_id', $kelompok_id)
            ->pluck('maxnb');

        if ($maxnb[0] == null) {
            $maxnb[0] = '1';
        }
        
        $cekbox25 = Pengecekan::where('no_box', $kd_kelompok.$maxnb[0])->where('kelompok_id', $kelompok_id)->count();

        if ($cekbox25 >= 2) {
            $nextnb = $maxnb[0] + 1;

            $nourutbox = $kd_kelompok . $nextnb;

            return view('ptsl.pengecekan.index',compact('nourutbox'));

        } else {
            $nextnb = $maxnb[0];

            $nourutbox = $kd_kelompok . $nextnb;

            return view('ptsl.pengecekan.index',compact('nourutbox'));

        }
    }
   
    public function store(Request $request)
    {
        // return "ok";
        // return Pengecekan::create($request->except(['_method','_token']));
        $data = User::with('kelompok')->where('id', auth()->user()->id)->first();
        $kd_kelompok = $data->kelompok->kd_kelompok;


        $cekdata = Pengecekan::where('no_berkas',$request->no_berkas)
                            ->where('no_hak',$request->no_hak)->first();
        if($cekdata != null)
        {
            Session::flash('danger', 'Data sudah diimput oleh kelompok '. $cekdata->kelompok_id);
            return View::make('layouts/alerts');
        }else{
            $kelompok_id = auth()->user()->kelompok_id;

            // return $user = DB::query('tbl_pengecekan')->substr('no_box',2)->first();
            $maxnb = DB::table('tbl_pengecekan')
                ->select(DB::raw('max(cast(substr(no_box,3) as signed)) as maxnb'))
                ->where('kelompok_id', $kelompok_id)
                ->pluck('maxnb');
            
            // $maxnb = Pengecekan::where('kelompok_id', $kelompok_id)->groupBy('no_box')->pluck('no_box')->max();
            if ($maxnb[0] == null) {
                $maxnb[0] = '1';
            }
            $cekbox25 = Pengecekan::where('no_box', $kd_kelompok.$maxnb[0])->where('kelompok_id', $kelompok_id)->count();

            if ($cekbox25 >= 2) {
                $nextnb = $maxnb[0] + 1;
                $nourutbox = $kd_kelompok . $nextnb;

                Pengecekan::create([
                    'kecamatan' => $request->kecamatan,
                    'desa' => $request->desa,
                    'kelompok_id' => auth()->user()->kelompok_id,
                    'keterangan' => $request->keterangan,
                    'no_208' => $request->no_208,
                    'no_berkas' => $request->no_berkas,
                    'no_box' => $nourutbox,
                    'no_su' => $request->no_su,
                    'no_hak' => $request->no_hak,
                    'pemegang' => $request->pemegang,
                    'tahun' => $request->tahun,
                ]);
            } else {
                $nextnb = $maxnb[0];
                $nourutbox = $kd_kelompok . $nextnb;

                Pengecekan::create([
                    'kecamatan' => $request->kecamatan,
                    'desa' => $request->desa,
                    'kelompok_id' => auth()->user()->kelompok_id,
                    'keterangan' => $request->keterangan,
                    'no_208' => $request->no_208,
                    'no_berkas' => $request->no_berkas,
                    'no_box' => $nourutbox,
                    'no_su' => $request->no_su,
                    'no_hak' => $request->no_hak,
                    'pemegang' => $request->pemegang,
                    'tahun' => $request->tahun,
                ]);
            }
            Session::flash('info', 'Data Berhasil Disimpan');
            return View::make('layouts/alerts');
        }

    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        return Pengecekan::find($id);
    }

    public function update(Request $request, $id)
    {
        $data = Pengecekan::find($id);
        $data->no_berkas = $request['no_berkas'];
        $data->no_hak = $request['no_hak'];
        $data->no_208 = $request['no_208'];
        $data->no_su = $request['no_su'];
        $data->tahun = $request['tahun'];
        $data->pemegang = $request['pemegang'];
        $data->desa = $request['desa'];
        $data->kecamatan = $request['kecamatan'];
        $data->no_box = $request['no_box'];
        $data->keterangan = $request['keterangan'];
        $data->rak = $request['rak'];
        $data->baris = $request['baris'];
        $data->posisi = $request['posisi'];

        $data->update();

        return $data;
    }

   
    public function destroy($id)
    {
        Pengecekan::destroy($id);
    }

    public function autoComplete(Request $request)
    {
        $query = $request->get('term','');

        $dataptsl=DataPtsl::where('no_berkas','LIKE','%'.$query.'%')->orWhere('tahun','LIKE','%'.$query.'%')->limit(30)->get();
        $data=array();
        foreach ($dataptsl as $ptsl) {
                $data[]=array('value'=>'No Berkas :'.$ptsl->no_berkas.' || No Hak :'.$ptsl->no_hak. ' || Tahun :' . $ptsl->tahun, 'id'=>$ptsl->no_berkas);
        }
        if (count($data)) {
            return $data;
        } else {
            return ['value'=>'No berkas atau Tahun tidak ada','id'=>''];
        }
    }

    public function showPtsl(Request $request)
    {
        $no_berkas = $request->get('no_berkas');
        $peg=DataPtsl::where('no_berkas', $no_berkas)->first();
        $data = array(
            'no_berkas'=>$peg->no_berkas,
            'tahun'=>$peg->tahun,
            'no_hak'=>$peg->no_hak,
            'no_208'=>$peg->no_208,
            'no_su'=>$peg->no_su,
            'pemegang'=>$peg->pemegang,
            'desa'=>$peg->desa,
            'kecamatan'=>$peg->kecamatan
        );
        $row_set[]              =$data;
        return $return = json_encode($row_set);

    }

}
