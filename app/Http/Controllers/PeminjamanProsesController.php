<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Auth;
use App\User;
use App\Peminjaman;
use App\PeminjamanMaster;

class PeminjamanProsesController extends Controller
{
   
    public function index()
    {
        return view('peminjaman.peminjamanproses.index');
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
    public function autoComplete(Request $request)
    {
        $query = $request->get('term','');
        $datamaster=PeminjamanMaster::where('idbukutanah','LIKE','%'.$query.'%')->limit(20)->get();
        $data=array();
        foreach ($datamaster as $datas) {
                $data[]=array('value'=>$datas->idbukutanah. ' || Desa: '.$datas->desa.' || Kec: '.$datas->kecamatan.' || Jenis Hak: '.$datas->jenis_hak, 'id'=>$datas->idbukutanah);
        }
        if (count($data)) {
            return $data;
        } else {
            return ['value'=>'Data yang anda cari tidak ada','id'=>''];
        }
    }

    public function showData(Request $request)
    {
        $id = $request->_;

        $datas=PeminjamanMaster::where('idbukutanah','=', $id)->get();

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
        $data = Peminjaman::orderBy('updated_at','desc')->get();

        return Datatables::of($data)
            ->addColumn('action',function($data){
                return ' <a onclick="editForm('.$data->id .')" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                        </i> </a>' .
                        ' <a onclick="deleteData('.$data->id .')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i> </a>';
            })->rawColumns(['action'])->make(true);
    }
}
