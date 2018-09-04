<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Auth;

use App\User;
use App\BukuTanah;

class BukutanahController extends Controller
{
    public function apiBukuTanah()
    {
        $data = BukuTanah::orderBy('updated_at','desc')->get();

        return Datatables::of($data)
            ->addColumn('action',function($data){
                return ' <a onclick="editForm('.$data->id .')" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                        </i> </a>' .
                        ' <a onclick="deleteData('.$data->id .')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i> </a>';
            })->rawColumns(['action'])->make(true);
    }
    public function index(){

        return view('bukutanah.index');
    }
}
