<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use App\User;
use Yajra\DataTables\DataTables;
use View;
use Session;



class UserPermissionController extends Controller
{
    public function index()
    {
        return view('user.permission.index');
        
    }

    public function store(Request $request)
    {
        $permission = Permission::create(['name' => $request->name]);
        
        return redirect()->back()->with('info', 'Permission berhasil dibuat');
    }

   public function apiData()
   {
    $data = Permission::query();

    return DataTables::of($data)
    ->addColumn('action', function($data){
        return ' <a onclick="editForm(' . $data->id . ')" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                    </i> </a>' .
                ' <a onclick="deleteData(' . $data->id . ')" class ="btn btn-danger"><i class="fa fa-trash-o">
                    </i> </a>';
    })
    ->rawColumns(['action'])->make(true);
   }

}
