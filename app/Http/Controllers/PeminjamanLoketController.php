<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Auth;

use App\User;
use App\Peminjaman;
use App\PeminjamanDetail;
use App\PeminjamanMaster;

class PeminjamanLoketController extends Controller
{
    public function apiPeminjamanLoket()
    {
        $data = Peminjaman::orderBy('updated_at','desc')->get();
        // $data->setRelation('children', $data->getDescendants()->toHierarchy())->with(['peminjamandetail']) ;

        return Datatables::of($data)
            ->addColumn('action',function($data){
                return ' <a onclick="editForm('.$data->id .')" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                        </i> </a>' .
                        ' <a onclick="deleteData('.$data->id .')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i> </a>';
            })->rawColumns(['action'])->make(true);
    }

    public function index(){

        return view('peminjaman.peminjamanloket.index');
    }
}
