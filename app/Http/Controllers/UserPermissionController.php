<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use App\User;


class UserPermissionController extends Controller
{
    public function index()
    {
        // return Permission::all();
        // return view('user.permission.index',compact('data'));
        
    }

}
