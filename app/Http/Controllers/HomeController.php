<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Kelompok;
use App\DataWarkah;
use App\Dashboard;
use App\Pengecekan;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Kelompok::with('pengecekan')->get();

        $collection = Pengecekan::all()->sort();

        $grouped = $collection->groupBy(function ($item, $key) {
            return $item['kecamatan'];
        });
        
       
        $data2 = $grouped->map(function ($item, $key) use($collection){
            return collect($item)->count();
        });

        $dashboard = Dashboard::pluck('kecamatan','target')->flip()->sort();
       
       
        return view('home',compact('data','data2','dashboard'));
    }
}
