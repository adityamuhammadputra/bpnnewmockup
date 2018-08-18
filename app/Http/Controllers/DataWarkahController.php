<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Datatables; 


use App\User;
use App\DataWarkah;



class DataWarkahController extends Controller
{
    
    public function apiWarkah()
    {
        $data = DataWarkah::orderBy('id')->get();

        // return $data;

        return Datatables::of($data)
            ->addColumn('action',function($data){

                return '<a href="#" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-open"></i>Show</a> ' .
                        ' <a onclick="editForm('.$data->id .')" class ="btn btn-primary btn-sm"><i class="glyphicon glyphicon-edit">
                        </i> Edit </a>' .
                        ' <a onclick="deleteData('.$data->id .')" class ="btn btn-warning btn-sm"><i class="glyphicon glyphicon-trash">
                        </i> Delete </a>';
            })->rawColumns(['action'])->make(true);

    }

    public function index()
    {
        return view('datawarkah.index');        
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
}
