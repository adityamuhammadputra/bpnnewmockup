<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Auth;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Permission;
// use Yajra\DataTables\Facades\DataTables;

class UserRoleController extends Controller
{
    public function index()
    {
        $data = Permission::all();
        return view('user.role.index',compact('data'));

    }

    public function store(Request $request)
    {
        $permission = $request->permission;

        $role = Role::create(['name' => $request->name]);
        if($permission){
            $role->syncPermissions($permission);
        }

        return redirect()->back()->with('info', 'Role '.$role['name'].' berhasil ditambah');
    }

    public function apidata()
    {
        $data = Role::with('permissions');
        return DataTables::of($data)
        ->addColumn('action', function($data){
            return ' <a onclick="editForm(' . $data->id . ')" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                        </i> </a>' .
                    ' <a onclick="deleteData(' . $data->id . ')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i> </a>';
        })
        ->addColumn('permissions',function($data){
            $foreach = '';
            foreach ($data->permissions as $permission) {
                $foreach .= '<ul><li>' . $permission->name . '</li></ul>';
            }
            return $foreach;
        })
        ->rawColumns(['action','permissions'])->make(true);
    }

}
