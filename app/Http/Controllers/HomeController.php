<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Kelompok;
use App\DataWarkah;
use App\Dashboard;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $datawarkah = DataWarkah::with('user')->get();
        $datadasboard = Dashboard::with('kelompok')->get();
        return $datadasboard;
        return view('home');
    }
}
