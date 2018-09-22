<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Auth;
use View;
use Session;
use App\User;
use App\PeminjamanMaster;

class PeminjamanMasterController extends Controller
{
    
    public function index(){

        return view('peminjaman.peminjamanmaster.index');
    }

    public function cek(Request $request){

        $checklike = PeminjamanMaster::where('id', '=', $request->id)
        ->where('status', '=', $request->status)
        ->first();

        if($checklike->status == 0)
        {
            $data = PeminjamanMaster::find($request->id);
            $data->status = 1;
            $data->update();
        }
        else{
            $data = PeminjamanMaster::find($request->id);
            $data->status = 0;
            $data->update();
        }

    }

    public function apiPeminjamanMaster()
    {
        $data = PeminjamanMaster::orderBy('status', 'desc');
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                if ($data->status == 1) {

                    return '<a id="cek" data-value="' . $data->status . '" data-id="' . $data->id . '" class="btn btn-success">
                            <i class="fa fa-check-square-o"></i> 
                        </a>                       
                        ' .
                        ' <a onclick="editForm(' . $data->id . ')" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                        </i> </a>' .
                        ' <a onclick="deleteData(' . $data->id . ')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i> </a>';
                } else {
                    return '<a id="cek" data-value="' . $data->status . '" data-id="' . $data->id . '" class="btn btn-warning">
                            <i class="fa fa-window-close-o"></i> 
                        </a>                       
                        ' .
                        ' <a onclick="editForm(' . $data->id . ')" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                        </i> </a>' .
                        ' <a onclick="deleteData(' . $data->id . ')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i> </a>';
                }

            })->rawColumns(['action'])->make(true);

    }
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return PeminjamanMaster::find($id);
    }

    public function update(Request $request, $id)
    {
        $data = PeminjamanMaster::find($id);
        $data->no_box = $request['no_box'];
        $data->idbukutanah = $request['idbukutanah'];
        $data->jenis_hak = $request['jenis_hak'];
        $data->no_hak = $request['no_hak'];
        $data->desa = $request['desa'];
        $data->kecamatan = $request['kecamatan'];
        $data->ruang = $request['ruang'];
        $data->rak = $request['rak'];
        $data->baris = $request['baris'];
        $data->status = $request['status'];
        
        $data->update();

        Session::flash('info', 'Data Berhasil Diubah');
        return View::make('layouts/alerts');


    }

    public function destroy($id)
    {
        PeminjamanMaster::destroy($id);
        Session::flash('info', 'Data Berhasil Dihapus');
        return View::make('layouts/alerts');
    }

    public function store(Request $request)
    {
        PeminjamanMaster::create($request->except(['_method', '_token']));

        Session::flash('info', 'Data Baru Berhasil Ditambah');
        return View::make('layouts/alerts');

    }
    
}
