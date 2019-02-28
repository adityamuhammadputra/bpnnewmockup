<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Auth;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Permission;
use View;
use Session;

class UserRoleController extends Controller
{
    public function index()
    {
        $data = Permission::all();
        $form = [
            'action' => url('userrole'),
            'method' => 'POST'
        ];
        return view('user.role.index',compact('data','form'));

    }

    public function edit($id)
    {
        $role = Role::with('permissions')->find($id);

        return $role;
    }

    public function store(Request $request)
    {
        $permission = $request->permission;

        if($request->id){
            $role = Role::find($request->id);
            if($permission){
                $role->syncPermissions($permission);
            }
            $role->update([
                'name' => $request->name,
            ]);
            $pesan = 'Diubah';

        }else {
            $role = Role::create(['name' => $request->name]);
            if($permission){
                $role->syncPermissions($permission);
            }
            $pesan = 'Ditambah';
        }

        return redirect()->back()->with('info', 'Role '.$role['name'].' berhasil '.$pesan);
    }

    public function apidata()
    {
        $data = Role::with('permissions');
        return DataTables::of($data)
        ->addColumn('action', function($data){
            return ' <a onclick="editData(' . $data->id . ')" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                        </i> </a>' .
                    ' <a onclick="deleteData(' . $data->id . ')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i> </a>';
        })
        ->addColumn('permissions',function($data){
            $foreach = '';
            foreach ($data->permissions as $permission) {
                $foreach .= '<span class="label label-info">' . $permission->name . '</span> ';
            }
            return $foreach;
        })
        ->rawColumns(['action','permissions'])->make(true);
    }

    public function destroy($id)
    {
        $data = Role::destroy($id);
 
        Session::flash('info','Role Berhasil dihapus');
        return View::make('layouts/alerts');
    }

}
