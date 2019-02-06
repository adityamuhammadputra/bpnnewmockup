<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Auth;
use View;
use Session;
use App\User;
use App\PeminjamanMaster;

use App\PeminjamanPengecekan;

class PeminjamanMasterController2 extends Controller
{
    
    public function index(){

        return view('peminjaman.peminjamanmaster2.index');
    }

    public function cekpinjam(Request $request)
    {

        $checklike = PeminjamanPengecekan::where('id', '=', $request->id)
            ->where('status_pinjam', '=', $request->status_pinjam)
            ->first();

        if ($checklike->status_pinjam == 0) {
            $data = PeminjamanPengecekan::find($request->id);
            $data->status_pinjam = 1;
            $data->update();

            Session::flash('info', 'Data Telah Masuk Diwallboard');
            return View::make('layouts/alerts');

        } else {
            $data = PeminjamanPengecekan::find($request->id);
            $data->status_pinjam = 0;
            $data->update();

            Session::flash('info', 'Data kembali tersedia');
            return View::make('layouts/alerts');
        }
        

    }

    public function apiPeminjamanMaster()
    {

        $data = PeminjamanPengecekan::orderBy('updated_at');

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                if ($data->status_pinjam == 0) {
                    return '<a id="cekpinjam" data-value="' . $data->status_pinjam . '" data-id="' . $data->id . '" class="btn btn-success">
                                <i class="fa fa-rocket"></i> 
                            </a>' .
                            ' <a onclick="deleteData(' . $data->id . ')" class ="btn btn-danger"><i class="fa fa-trash-o">
                            </i> </a>'.
                            ' <a onclick="editForm(' . $data->id . ')" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                            </i> </a>';
                } else {
                    return '<a id="cekpinjam" data-value="' . $data->status_pinjam . '" data-id="' . $data->id . '" class="btn btn-warning">
                                <i class="fa fa-rocket"></i> 
                            </a>' .
                            ' <a onclick="deleteData(' . $data->id . ')" class ="btn btn-danger"><i class="fa fa-trash-o">
                            </i> </a>'.
                            '<a onclick="editForm(' . $data->id . ')" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                            </i> </a>';
                    
                }

            })->rawColumns(['action'])->make(true);

    }
    public function autoCompletePeminjaman(Request $request)
    {
        $query = $request->get('term','');
        $dataptsl = PeminjamanMaster::where('idbukutanah', 'LIKE', '%' . $query . '%')->limit(20)->get();
        $data = [];
        foreach ($dataptsl as $d) {
            $data[] = array('value' => $d->idbukutanah . ' || Jenis Hak: ' . $d->jenis_hak . ' || No Hak: ' . $d->no_hak . ' || Desa: ' . $d->desa . ' || Kec: ' . $d->kecamatan, 'id' => $d->idbukutanah);
        }
        if (count($data)) {
            return $data;
        } else {
            return ['value' => 'Data tidak ada', 'id' => ''];
        }
    }

    public function autoCompletePeminjamanshow(Request $request)
    {
        $id = $request->idbukutanah;

        $datas = PeminjamanMaster::where('idbukutanah', $id)->first();
        $data = array(
            'idbukutanah' => $datas->idbukutanah,
            'kecamatan' => $datas->kecamatan,
            'desa' => $datas->desa,
            'jenis_hak' => $datas->jenis_hak,
            'no_hak' => $datas->no_hak,
            'no_box' => $datas->no_box,
        );
        $row_set[] = $data;
        return $return = json_encode($row_set);
    }


    public function edit($id)
    {
        return PeminjamanPengecekan::find($id);
    }

    public function update(Request $request, $id)
    {
        $data = PeminjamanPengecekan::find($id);
        $data->no_box = $request['no_box'];
        $data->idbukutanah = $request['idbukutanah'];
        $data->jenis_hak = $request['jenis_hak'];
        $data->no_hak = $request['no_hak'];
        $data->desa = $request['desa'];
        $data->kecamatan = $request['kecamatan'];
        $data->ruang = $request['ruang'];
        $data->rak = $request['rak'];
        $data->baris = $request['baris'];
        $data->status = $request['status'];
        
        $data->update();

        Session::flash('info', 'Data Berhasil Diubah');
        return View::make('layouts/alerts');


    }

    public function destroy($id)
    {
        PeminjamanPengecekan::destroy($id);
        Session::flash('info', 'Data Berhasil Dihapus');
        return View::make('layouts/alerts');
    }

    public function store(Request $request)
    {
        PeminjamanPengecekan::create($request->except(['_method', '_token']));

        Session::flash('info', 'Data Baru Berhasil Ditambah');
        return View::make('layouts/alerts');

    }
    
}
