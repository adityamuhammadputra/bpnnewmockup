<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;


use Auth;
use App\User;
use App\Peta;

class PetaController extends Controller
{

    public function index()
    {
        return view('peta.index');
    }


    public function show($id)
    {
        $data = Peta::where('id',$id)->first();
        return view('peta.show', compact('data'));
    }
   
}
