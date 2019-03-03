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
class PeminjamanMasterController extends Controller

{
    public function index(){
        $this->authorize('bukutanah.read');
        return view('peminjaman.peminjamanmaster.index');
    }

    public function cekpinjam(Request $request)
    {
        $this->authorize('bukutanah.crud');
        $checklike = PeminjamanPengecekan::where('id', '=', $request->id)
            ->where('status_pinjam', '=', $request->status_pinjam)
            ->first();

        if ($checklike->status_pinjam == 0) {
            $data = PeminjamanPengecekan::find($request->id);
            $data->status_pinjam = 1;
            $data->update();
            Session::flash('info', 'BT tidak tersedia');
            return View::make('layouts/alerts');
        } else {
            $data = PeminjamanPengecekan::find($request->id);
            $data->status_pinjam = 0;
            $data->update();
            Session::flash('info', 'BT kembali tersedia');
            return View::make('layouts/alerts');
        }
    }
    public function cekpinjam2(Request $request)
    {
        $this->authorize('bukutanah.crud');
        $checklike = PeminjamanPengecekan::where('id', '=', $request->id)
        ->where('status_pinjam2', '=', $request->status_pinjam2)
        ->first();
        if ($checklike->status_pinjam2 == 0) {
            $data = PeminjamanPengecekan::find($request->id);
            $data->status_pinjam2 = 1;
            $data->update();
            Session::flash('info', 'SU tidak tersedia');
            return View::make('layouts/alerts');

        } else {
            $data = PeminjamanPengecekan::find($request->id);
            $data->status_pinjam2 = 0;
            $data->update();
            Session::flash('info', 'SU kembali tersedia');
            return View::make('layouts/alerts');
        }

    }



    public function apiPeminjamanMaster()
    {
        // $data = PeminjamanPengecekan::all();
        $this->authorize('bukutanah.read');
        $data = PeminjamanPengecekan::orderBy('updated_at');
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
            return ' <a onclick="deleteData(' . $data->id . ')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i> </a>'.
                        ' <a onclick="editForm(' . $data->id . ')" class ="btn btn-primary"><i class="fa fa-pencil-square-o">
                        </i> </a>';
            })
            ->addColumn('statussu', function ($data){
                return '<a id="cekpinjam" title="klik untuk ubah status BT" data-value="' . $data->status_pinjam . '" data-id="' . $data->id . '" class="'.$data->labelsu.'
                        </a>';
            })
            ->addColumn('statusbt', function ($data){
                return '<a id="cekpinjam2" title="klik untuk ubah status SU" data-value="' . $data->status_pinjam2 . '" data-id="' . $data->id . '" class="'.$data->labelbt.'

                        </a>';
            })

            ->rawColumns(['action','statussu','statusbt'])->make(true);
    }

    public function autoCompletePeminjaman(Request $request)
    {
        $this->authorize('bukutanah.crud');
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
        $this->authorize('bukutanah.crud');
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
        $this->authorize('bukutanah.read');
        return PeminjamanPengecekan::find($id);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('bukutanah.crud');
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
        $data->status_pinjam = $request['status_pinjam'];
        $data->status_pinjam2 = $request['status_pinjam2'];
        $data->created_by = $request['created_by'];
        $data->update();

        Session::flash('info', 'Data Berhasil Diubah');

        return View::make('layouts/alerts');

    }

    public function destroy($id)
    {
        $this->authorize('bukutanah.crud');
        PeminjamanPengecekan::destroy($id);
        Session::flash('info', 'Data Berhasil Dihapus');

        return View::make('layouts/alerts');
    }

    public function store(Request $request)
    {
        $this->authorize('bukutanah.crud');
        PeminjamanPengecekan::create($request->except(['_method', '_token']));
        Session::flash('info', 'Data Baru Berhasil Ditambah');
        return View::make('layouts/alerts');
    }

    

}

