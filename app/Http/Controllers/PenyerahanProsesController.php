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
use App\KodeBox;

use App\Mail\NotifMail;

class PenyerahanProsesController extends Controller
{
    public function __construct()
    {
        $datetime = Carbon::now();
        $replace = array(" ", ":");
        $datetime = str_replace($replace, '-', $datetime);

        $this->datetime = $datetime;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('penyerahanproses.read');
        $kegiatan = Kegiatan::orderBy('no_urut', 'asc')->pluck('nama_kegiatan', 'id')->toArray();
        $kegiatan = ['' => '---- Pilih ----'] + $kegiatan;

        $max = DB::table('penyerahan')
            ->select(DB::raw('max(no_urut) as no_urut'))
            ->where('user_id', Auth::user()->id)
            ->pluck('no_urut');

        $no_urut = $max[0];
        $data = Penyerahan::where('kd_cetak', Auth::user()->id . $max[0])->count();

        if($data < 1){
            $data = '1';
            $no_urut = '1';
        }elseif($data >= 25) {
            $data = $max[0] + 1;
            $no_urut = $no_urut+1;
        }else {
            $data = $max[0];
        }

        $kd_cetak = Auth::user()->id. $data;

        $kodebox = KodeBox::pluck('value','label');

        return view('penyerahan.penyerahanproses.index',compact('kegiatan', 'kd_cetak', 'kodebox','no_urut'));
    }

    
    public function create()
    {
    }

    
    public function store(Request $request)
    {
        $this->authorize('penyerahanproses.crud');
        Penyerahan::create([
            'no_berkas' => $request->no_berkas,
            'kd_box' => $request->kd_box,
            'nama1' => $request->nama1,
            'tanggal1' => $request->tanggal1,
            'email' => $request->email,
            'status' => $request->status,
            'kegiatan_id' => $request->kegiatan_id,
            'user_id' => auth()->user()->id,
            'no_urut' => $request->no_urut,
            'kd_cetak' => $request->kd_cetak,
            'catatan' => $request->catatan,
        ]);
        $penyerahanid = DB::getPdo()->lastInsertId();

        if ($request->jenis_hak != null) {
            $datas = [];
            for ($i = 0; $i < count($request->jenis_hak); $i++) {
                $datas = [
                    'penyerahan_id' => $penyerahanid,
                    'no_hak' => $request->no_hak[$i],
                    'jenis_hak' => $request->jenis_hak[$i],
                    'desa' => $request->desa[$i],
                    'kecamatan' => $request->kecamatan[$i],
                    'no_warkah' => $request->no_warkah[$i],
                ];

                PenyerahanDetail::insert($datas);
            }
        }
        $kegiatan = Kegiatan::find($request->kegiatan_id);
        
        if ($request->status == 1) {//Tunggakan
            $text = 'YTH: ' . $request->nama1 . ' Dengan NoBerkas ' . $request->no_berkas . ', ' . $kegiatan->nama_kegiatan . '. masih dalam proses, Kami akan menginformasikan kembali status Berkas Anda. Terimakasih';
        }elseif ($request->status == 2) { //Tidak lengkap
            $text = 'YTH: ' . $request->nama1 . ' Berkas ' . $request->no_berkas . ', ' . $kegiatan->nama_kegiatan . '. Tidak Lengkap (' . $request->catatan . ') Silahkan Datang ke Loket CS. Nilai Layanan Kami di http://ikm.atrbpn.go.id';
        }else { //selesai
            $text = 'YTH: ' . $request->nama1 . ' Berkas ' . $request->no_berkas . ', ' . $kegiatan->nama_kegiatan . ' Telah Selesai. Silahkan Datang ke KANTAH KAB.BOGOR. Nilai Layanan Kami di http://ikm.atrbpn.go.id';
        }
        

        $sms = new smsmasking();

        $sms->username = 'adityamuhammadputra';
        $sms->password = '741599';
        $sms->apikey = '31208ea4c56acbb64c8973004d1351ed';
        $sms->setTo($request->email);
        $sms->setText($text);
        $sts = $sms->smssend();     

        return redirect()->back()->withInput()->with('success', 'Data Berhasil Disimpan');
    }

    
    public function show($id)
    {
        //
    }
    public function cetak(Request $request)
    {
        $this->authorize('penyerahanproses.crud');
        $datetime = $this->datetime;

        $id = $request->cetak;
        $data = Penyerahan::with('kegiatan')->where('kd_cetak', $id)->where('status',3)->get();
        $data = [
            'data' => $data,
            'id' => $id,
        ];
        Penyerahan::where('kd_cetak', $id)->update([
            'tanggal_penyerahan' => $datetime,
        ]);


        $pdf = PDF::loadView('penyerahan.penyerahanproses.cetak', $data);
        $pdf->save(storage_path() . '/app/pdf/cetakpenyerahanproses' . $datetime . '.pdf');
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function cetakbox(Request $request)
    {
        $this->authorize('penyerahanproses.crud');
        $datetime = $this->datetime;

        $id = $request->id;
        $data = Penyerahan::with('kegiatan')->whereIn('id',$id)->get();
        $data = [
            'data' => $data,
        ];
        $pdf = PDF::loadView('penyerahan.penyerahanproses.cetak', $data);
        $pdf->save(storage_path() . '/app/pdf/cetakpenyerahanprosescombox' . $datetime . '.pdf');
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();

    }
   
    public function edit($id)
    {
        $this->authorize('penyerahanproses.crud');
        return Penyerahan::with('kegiatan', 'penyerahandetail')->find($id);
    }

  
    public function update(Request $request, $id)
    {
        $this->authorize('penyerahanproses.crud');
        $inputpenyerahan = $request->only('no_berkas', 'nama1', 'email', 'status', 'kegiatan_id', 'kd_box', 'no_urut' , 'kd_cetak', 'tanggal1' , 'catatan');
        $data = Penyerahan::find($id);
        $data->update(
            $inputpenyerahan
        );

        if($request->no_hak){
            PenyerahanDetail::where('penyerahan_id', $id)->delete();
            for ($i = 0; $i < count($request->jenis_hak); $i++) {
                $datas[] = [
                    'penyerahan_id' => $id,
                    'no_hak' => $request->no_hak[$i],
                    'jenis_hak' => $request->jenis_hak[$i],
                    'desa' => $request->desa[$i],
                    'kecamatan' => $request->kecamatan[$i],
                    'no_warkah' => $request->no_warkah[$i],
                    'user_id' => Auth::user()->id,
                ];
            }
            PenyerahanDetail::insert($datas);
        }

        $penyerahan = Penyerahan::find($id);
        $kegiatan = Kegiatan::find($penyerahan->kegiatan_id);

        if ($request->status == 1) {//Tunggakan
            $text = 'YTH: ' . $penyerahan->nama1 . ' Dengan NoBerkas ' . $penyerahan->no_berkas . ', ' . $kegiatan->nama_kegiatan . '. masih dalam proses, Kami akan menginformasikan kembali status Berkas Anda. Terimakasih';
        } elseif ($request->status == 2) { //Tidak lengkap
            $text = 'YTH: ' . $penyerahan->nama1 . ' Dengan NoBerkas ' . $penyerahan->no_berkas . ', ' . $kegiatan->nama_kegiatan . '. Tidak lengkap (' . $penyerahan->catatan . ') Silahkan datang ke Kantor Pertanahan Kab.Bogor';
        } else { //selesai
            $text = 'YTH: ' . $penyerahan->nama1 . ' Dengan NoBerkas ' . $penyerahan->no_berkas . ', ' . $kegiatan->nama_kegiatan . '. Telah selesai diproses. Silahkan datang ke Loket Penyerahan Kantor Pertanahan Kab.Bogor';
        }


        $sms = new smsmasking();

        $sms->username = 'adityamuhammadputra';
        $sms->password = '741599';
        $sms->apikey = '31208ea4c56acbb64c8973004d1351ed';
        $sms->setTo($penyerahan->email);
        $sms->setText($text);
        $sts = $sms->smssend();  

        return redirect()->back()->withSuccess('Data berhasil diperbaharui');

    }

    
    public function destroy($id)
    {
        $this->authorize('penyerahanproses.crud');
        Penyerahan::destroy($id);

        Session::flash('info', 'Data Berhasil Dihapus');
        return View::make('layouts/alerts');
    }

    public function penyerahanprosesstatus(Request $request)
    {
        $this->authorize('penyerahanproses.crud');
        $max = DB::table('penyerahan')
            ->select(DB::raw('max(no_urut) as no_urut'))
            ->where('user_id', Auth::user()->id)
            ->pluck('no_urut');

        $no_urut = $max[0];
        $data = Penyerahan::where('kd_cetak', Auth::user()->id . $max[0])->count();

        if ($data < 1) {
            $data = '1';
            $no_urut = '1';
        } elseif ($data >= 25) {
            $data = $max[0] + 1;
            $no_urut = $no_urut + 1;
        } else {
            $data = $max[0];
        }

        $kd_cetak = Auth::user()->id . $data;
        
        Penyerahan::where('id', $request->id)->update([
            'status' => $request->status_update,
            'kd_box' => $request->kd_box_update,
            'tanggal1' => $request->tanggal1,
            'kd_cetak' => $kd_cetak,
            'user_id' => Auth::user()->id,
        ]);


        $penyerahan = Penyerahan::find($request->id);
        $kegiatan = Kegiatan::find($penyerahan->kegiatan_id);

        if ($request->status_update == 1) {//Tunggakan
            $text = 'YTH: ' . $penyerahan->nama1 . ' Dengan NoBerkas ' . $penyerahan->no_berkas . ', ' . $kegiatan->nama_kegiatan . '. masih dalam proses, Kami akan menginformasikan kembali status Berkas Anda. Terimakasih';
        } elseif ($request->status_update == 2) { //Tidak lengkap
            $text = 'YTH: ' . $penyerahan->nama1 . ' Dengan NoBerkas ' . $penyerahan->no_berkas . ', ' . $kegiatan->nama_kegiatan . '. Tidak lengkap (' . $penyerahan->catatan . ') Silahkan datang ke Kantor Pertanahan Kab.Bogor';
        } else { //selesai
            $text = 'YTH: ' . $penyerahan->nama1 . ' Dengan NoBerkas ' . $penyerahan->no_berkas . ', ' . $kegiatan->nama_kegiatan . '. Telah selesai diproses. Silahkan datang ke Loket Penyerahan Kantor Pertanahan Kab.Bogor';
        }


        $sms = new smsmasking();

        $sms->username = 'adityamuhammadputra';
        $sms->password = '741599';
        $sms->apikey = '31208ea4c56acbb64c8973004d1351ed';
        $sms->setTo($penyerahan->email);
        $sms->setText($text);
        $sts = $sms->smssend();     

        Session::flash('success', 'Status berhasil dirubah');
        return View::make('layouts/alerts');

    }

    public function apiPenyerahan()
    {
        $this->authorize('penyerahanproses.read', 'penyerahanloket.read');
        $data = Penyerahan::with('kegiatan', 'penyerahandetail')
            ->whereNull('status_cetak')
            ->orderBy('created_at', 'desc');
        // if (Auth::user()->id != 2) {
        //     $data->where('kegiatan_id',Auth::user()->kegiatan_penyerahan_id);
        // }
        
        return Datatables::of($data)
            ->addColumn('status_update', function($data){
                if ($data->status == 3) {
                    return '<span class="label label-success control-label"> Berkas Selesai </span>';
                }else {

                    if ($data->status == 1) {
                        $judul = 'Tunggakan';
                    }elseif($data->status == 2) {
                        $judul = 'Tidak Lengkap';
                    }else {
                        $judul = 'Selesai';
                    }
                    return '
                        <select class="form-control" name="status_update" id="status_update"  style="width: 150px;"  data-id="'.$data->id.'">
                            <option value="'.$data->status.'" name="selesai">'.$judul.'</option>
                            <option value="3" name="selesai">Selesai</option>
                            <option value="2" name="revisi">Tidak Lengkap</option>
                            <option value="1" name="tunggakan">Tunggakan</option>
                        </select>
                    ';
                }
            })
            ->addColumn('kd_box_update', function($data){
                if ($data->status == 3) {
                    return '<input type="text" class="form-control" value="' . $data->kd_box . '" style="width: 80px;" readonly>';
                } else {
                    return '
                        <input type="text" name="kd_box_update" class="form-control" value="'.$data->kd_box.'" id="kd_box_update" style="width: 80px;">
                    ';
                }
            })
            ->addColumn('cekbox', function ($data){
                return '<input type="checkbox" onchange="hideshow()" id="checkboxone'.$data->id.'" name="id[]" value="'. $data->id. '" class="inp-cbx checkbox" style="display: none;">
                        <label class="cbx" for="checkboxone'.$data->id.'"><span>
                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                        </svg></span><span></span></label>
                        ';
            })
            ->addColumn('action', function ($data) {
                return ' <a onclick="editForm(' . $data->id . ')" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                        </i> </a>' . 
                        ' <a onclick="deleteData(' . $data->id . ')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i> </a>';
            })->rawColumns(['action', 'kd_box_update', 'status_update', 'cekbox'])->make(true);
    }
}
