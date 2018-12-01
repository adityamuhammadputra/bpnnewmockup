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
// use Storage;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Kegiatan;
use App\Penyerahan;
use App\PenyerahanDetail;


class PenyerahanLoketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        return view('penyerahan.penyerahanloket.index');
    }


   
    public function edit($id)
    {
        // return $id;
        $kegiatan = Kegiatan::orderBy('no_urut', 'asc')->pluck('nama_kegiatan', 'id')->toArray();
        $kegiatan = ['' => '---- Pilih Kegiatan ----'] + $kegiatan;
        $detail = Penyerahan::find($id);
        $data = [
            'kegiatan' => $kegiatan,
            'id' => $id,
            'detail' => $detail,
        ];

        // return $data;

        return view('penyerahan.penyerahanloket.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->except('_method','_token', 'data-detail_length');
        // return $input;
        $data = Penyerahan::where('id',$id)->update(
          $input
        );

        return redirect()->back()->withSuccess('Data berhasil dirubah');

    }

    public function destroy($id)
    {
        Penyerahan::destroy($id);

        Session::flash('info', 'Data Berhasil Dihapus');
        return View::make('layouts/alerts');
    }

    public function kamera(Request $request)
    {
        return view('penyerahan.penyerahanloket.kamera');
    }

    public function kameraAksi(Request $request)
    {
        // return $request->namafile;
        $img = $request['image'];
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $namafile = $request->id_kamera.".png";
        $namafiledanpath = "public/".$namafile;

        Storage::put($namafiledanpath, $image_base64);

        Penyerahan::where('id',$request->id_kamera)->update(['foto' => 'app/'.$namafiledanpath]);

        return redirect()->back()->withSuccess('Foto berhasil ditambah');


        
    }

    public function cetak($id)
    {
        $datetime = Carbon::now();
        // return $datetime;
        $replace = array(" ", ":");
        $datetime = str_replace($replace, '-', $datetime);

        $data = Penyerahan::with('penyerahandetail')->find($id);
        $data->update([
            'status_cetak' => '1',
        ]);
        $kegiatan = $data->kegiatan()->first();


        $data = [
            'data' => $data,
            'kegiatan' => $kegiatan
        ];
        $pdf = PDF::loadView('penyerahan.penyerahanloket.cetak', $data);
        $pdf->save(storage_path() . '/app/pdf/cetakpenyerahanloket' . $datetime . '.pdf');
        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();

    }
    public function apiPenyerahan()
    {
        
        $data = Penyerahan::with('kegiatan', 'penyerahandetail')->where('user_id', auth()->user()->id)->whereNull('status_cetak')->orderBy('updated_at', 'desc');
        // return $data->get();
        return Datatables::of($data)

            ->addColumn('action', function ($data) {
                return ' <span class="label label-danger label-borok">' . $data->jumlah . '</span><a href="penyerahanloket/' . $data->id . '/edit" class ="btn btn-primary"><em class="fa fa-pencil-square-o">
                        </em> </a>' .
                    ' <a onclick="deleteData(' . $data->id . ')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i> </a>';
            })->rawColumns(['action'])->make(true);
        
            
    }

    public function apiDetail($id)
    {
        $data = PenyerahanDetail::where('penyerahan_id', $id)->orderBy('created_at', 'desc');
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return ' <a onclick="deleteDetail(' . $data->id . ')" class ="btn btn-danger"><i class="fa fa-trash-o">
                    </i> </a>';
            })->rawColumns(['action'])->make(true);

    }
}
