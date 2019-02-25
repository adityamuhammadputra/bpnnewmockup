<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\User;
use Spatie\Permission\Models\Role;



class UserController extends Controller
{
   
    public function apiUser()
    {
        $user = User::all();

        return Datatables::of($user)
            ->addColumn('show_photo',function($user){
                if ($user->photo== null){
                    return 'No images';
                }
                return '<img class="rounded-square" windth="50" height="50" src="'.url($user->photo).'" alt="">';
            })
            ->addColumn('action',function($user){

                return' <a onclick="editForm('.$user->id .')" class ="btn btn-primary btn-sm"><i class="glyphicon glyphicon-edit">
                        </i> Edit </a>' .
                        ' <a onclick="deleteData('.$user->id .')" class ="btn btn-warning btn-sm"><i class="glyphicon glyphicon-trash">
                        </i> Delete </a>';
            })->rawColumns(['show_photo', 'action'])->make(true);


    }


    public function index()
    {
        $data = Role::all();

        return view('user.index',compact('data'));
    }

   
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);

        $input['photo'] = null;

        // if ($request->hasFile('photo')){
        //     $input['photo'] = '/upload/photo/'.str_slug($input['name'],'-').'.'.$request->photo->getClientOriginalExtension();
        //     $request->photo->move(public_path('/upload/photo/'), $input['photo']);
        // }

        // return User::create($input);

        
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $contact = User::find($id);

        return $contact;
    }

   
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);

        $contact = User::findOrFail($id);

        $input['photo'] = $contact->photo;

        if($request->hasFile('photo'))
        {
            if($contact->photo != null)
            {
                unlink(public_path($contact->photo));
            }

            $input['photo'] = '/upload/photo/'.str_slug($input['name'],'-').'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('/upload/photo/'), $input['photo']);
        }
        $contact->update($input);

        return response()->json([
            'success'=>true,
            'message' => 'Contact Updated'
        ]);
    }

   
    public function destroy($id)
    {
        $data = User::findOrFail($id);

        if($data->photo != null)
        {
            unlink(public_path($data->photo));
        }
        User::destroy($id);

        return response()->json([
            'success'=>true,
            'message' => 'Contact Deleted'
        ]);

    }

    public function editprofile($id)
    {
        if($id != Auth::user()->id){
            return redirect()->back()->withDanger('Mohon maaf anda tidak mempunyai untuk mengubah akun lain');
        }

        return view('user.editprofile',compact('id'));
    }

    public function updateprofile(Request $request,$id)
    {
        $user = User::find($id);
        $input = $request->except('password');
        $input['email'] = $input['email'].'@gmail.com';
        
        if($request->password)
        {
            $input['password'] = Hash::make($request->password);
        }

        if($request->file('photo')){

            $filesize = $request->file('photo')->getClientSize();
            if ($filesize >= 2009834) {
                return redirect()->back()->withInput($request->all())->withInfo('Ukutan foto lebih dari 2Mb');
            }

            if($user->photo){
                unlink(public_path($user->photo));
            }
            $input['photo'] = '/upload/photo/'.str_slug($input['name'].$id).'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('/upload/photo'), $input['photo']);
        }

        $user->update(
            $input
        );

        return redirect()->back()->withSuccess('Profile Berhasil diupdate');
    }

    public function cekusers(Request $request)
    {
        $email = $request->email."@gmail.com";
        if($request->email){
            $data = User::where('email', $email)->count();
            if($data == 1 && Auth::user()->email."@gmail.com" != $email){
                echo "ada";
            }
            else {
                echo "tidak";
            }
        }
    }
}
