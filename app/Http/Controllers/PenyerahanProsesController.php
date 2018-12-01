<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Form;
use DB;
use PDF;
use Auth;
use View;
use Session;
use Carbon;

use App\User;
use App\Kegiatan;
use App\Penyerahan;
use App\PenyerahanDetail;

use App\Mail\NotifMail;

class PenyerahanProsesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kegiatan = Kegiatan::orderBy('no_urut', 'asc')->pluck('nama_kegiatan', 'id')->toArray();
        $kegiatan = ['' => '---- Pilih ----'] + $kegiatan;

        return view('penyerahan.penyerahanproses.index',compact('kegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Penyerahan::create([
            'no_berkas' => $request->no_berkas,
            'kd_box' => $request->kd_box,
            'nama1' => $request->nama1,
            'tanggal1' => $request->tanggal1,
            'email' => $request->email,
            'status' => $request->status,
            'kegiatan_id' => $request->kegiatan_id,
            'user_id' => auth()->user()->id,
        ]);
        $penyerahanid = DB::getPdo()->lastInsertId();

        if ($request->idbukutanah != null) {
            $datas = [];
            for ($i = 0; $i < count($request->idbukutanah); $i++) {
                $datas = [
                    'penyerahan_id' => $penyerahanid,
                    'idbukutanah' => $request->idbukutanah[$i],
                    'no_hak' => $request->no_hak[$i],
                    'jenis_hak' => $request->jenis_hak[$i],
                    'desa' => $request->desa[$i],
                    'kecamatan' => $request->kecamatan[$i],
                    'no_warkah' => $request->no_warkah[$i],
                    'tahun' => $request->tahun[$i],
                ];

                PenyerahanDetail::insert($datas);
            }
        }

        $nexmo = app('Nexmo\Client');

        $nexmo->message()->send([
            'to' => '6288225872452',
            'from' => 'BPN Bogor',
            'text' => 'Hay '.$request->nama1.', Nomor Berkas anda #'.$request->no_berkas.', Sudah selesai diproses....',
        ]);


        // $to = $request->email;
        // $data = [
        //     'no_berkas' => $request->no_berkas,
        //     'nama1' => $request->nama1,
        //     'admin' => auth()->user()->name,

        // ];

        // \Mail::to($to)->send(new NotifMail($data));


        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Penyerahan::destroy($id);

        Session::flash('info', 'Data Berhasil Dihapus');
        return View::make('layouts/alerts');
    }

    public function apiPenyerahan()
    {
        
        $data = Penyerahan::with('kegiatan', 'penyerahandetail')->where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc');
        return Datatables::of($data)

            ->addColumn('action', function ($data) {
                return ' <a onclick="deleteData(' . $data->id . ')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i> </a>';
            })->rawColumns(['action'])->make(true);
    }
}
