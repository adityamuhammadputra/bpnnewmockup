<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Datatables; 


use App\User;
use App\DataPtsl;
use Auth;

class PtslController extends Controller
{
    public function apiPtsl()
    {
        $this->authorize('ptsl.read');
        $data = DataPtsl::orderBy('id');

        return Datatables::of($data)
            ->addColumn('action',function($data){
                return ' <a onclick="editForm('.$data->id .')" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                        </i> </a>' .
                        ' <a onclick="deleteData('.$data->id .')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i> </a>';
            })->rawColumns(['action'])->make(true);
    }
   
    public function index()
    {
        $this->authorize('ptsl.read');
        return view('ptsl.index');
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
