<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Auth;
use View;
use Session;
use Carbon;
use PDF;

// use Storage;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Kegiatan;
use App\Penyerahan;
use App\PenyerahanDetail;

class PenyerahanHistoryController extends Controller
{
    public function index()
    {
        $this->authorize('penyerahanloket.read', 'penyerahanproses.read');   
        return view('penyerahan.penyerahanhistory.index');
    }

    public function apiPenyerahan(Request $request)
    {
        $this->authorize('penyerahanloket.read', 'penyerahanproses.read');        
        $data = Penyerahan::with('kegiatan', 'penyerahandetail')
            ->where('status', 3);
            
        return Datatables::of($data)
        ->addColumn('fotos', function ($data) {
            if ($data->foto == null) {
                return 'No images';
            }
            return '<img class="rounded-square" windth="50" height="50" src="storage/'. $data->foto . '" alt="">';
        })->rawColumns(['fotos'])->make(true);
    }
  

    public function cetak(Request $request)
    {
        // $tanggalawal = $this->dateConverter($request->tanggal_awal);
        // $tanggalakhir = $this->dateConverter($request->tanggal_akhir);
        $this->authorize('penyerahanloket.read', 'penyerahanproses.read');        
        if ($request->tanggal_awal) {
            $data = Penyerahan::with('kegiatan', 'penyerahandetail')
                ->where('status', 3)->whereBetween('tanggal1', [$request->tanggal_awal . ' 00.00', $request->tanggal_akhir. ' 23.59']);
        }
        if ($request->status_cetak) {
            if ($request->status_cetak == 1) {
                $data->where('foto','!=' ,'app/public/default.png');
            }else{
                $data->where('foto','app/public/default.png');
            }
        }
        $data = $data->get();
        $datetime = Carbon::now();
        $replace = array(" ", ":");
        $datetime = str_replace($replace, '-', $datetime);

        $data = [
            'data' => $data,
            'tanggalmulai' => $request->tanggal_awal,
            'tanggalselesai' => $request->tanggal_akhir,
        ];
        $pdf = PDF::loadView('penyerahan.penyerahanhistory.cetak', $data);
        $pdf->save(storage_path() . '/app/pdf/cetakpenyerahandetail' . $datetime . '.pdf');
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    function dateConverter($date)
    {
        if ($date != null) {
            $formated = str_replace('/', '-', $date);
            $dateFormated = Carbon\Carbon::parse($formated);
            return $dateFormated->format('Y-m-d');
        } else {
            return null;
        }
    }
}
