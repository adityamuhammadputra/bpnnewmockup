<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Datatables; 


use App\User;
use App\DataWarkah;



class WarkahController extends Controller
{
    
    public function apiWarkah()
    {
        $this->authorize('warkah.read');
        $data = DataWarkah::orderBy('id');

        // return $data;

        return Datatables::of($data)
            ->addColumn('action',function($data){

                return '<a href="#" class="btn btn-info"><i class="fa fa-eye"></i></a> ' .
                        ' <a onclick="editData('.$data->id .')" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                        </i></a>' .
                        ' <a onclick="deleteData('.$data->id .')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i></a>';
            })->rawColumns(['action'])->make(true);

    }

    public function index()
    {
        $this->authorize('warkah.read');
        return view('datawarkah.index');        
    }
    
    public function store(Request $request)
    {
        $this->authorize('warkah.crud');
        return DataWarkah::create($request->except(['_method','_token']));
    }
   
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('warkah.crud');
        return DataWarkah::find($id);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('warkah.crud');
        $data = DataWarkah::find($id);
        $data->no_warkah = $request['no_warkah'];
        $data->no_box = $request['no_box'];
        $data->tahun = $request['tahun'];
        $data->lokasi_ruang = $request['lokasi_ruang'];
        $data->posisi = $request['posisi'];
        $data->rak = $request['rak'];
        $data->baris = $request['baris'];

        $data->update();
    
    }

    
    public function destroy($id)
    {
        $this->authorize('warkah.crud');
        DataWarkah::destroy($id);
    }
}
