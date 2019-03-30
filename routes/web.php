<?php
Route::get('/', function () {
    // return view('auth.login');
    return redirect(url('login'));

});

Route::get('/register', function () {
    return redirect(url('login'));
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    // Route::get('peta', 'PetaController@index');

Route::get('/home', 'PetaController@index')->name('home');
Route::get('peta/{id}', 'PetaController@show');
Route::get('getpeta', 'PetaController@apiMaps');

// Dashboard Arsip
Route::get('/dashboardarsip', 'DashboardArsipController@index')->name('dashboardarsip');

//warkah
Route::resource('/datawarkah','WarkahController')->except(['create']);
Route::get('api/warkah','WarkahController@apiWarkah')->name('api.warkah');

//ptsl
Route::resource('/dataptsl','PtslController')->only(['index']);
Route::get('api/ptsl','PtslController@apiPtsl')->name('api.ptsl');

//Pengecekan
Route::resource('/pengecekan','PengecekanController')->except(['create']);
Route::get('api/pengecekan','PengecekanController@apiPengecekan')->name('api.pengecekan');
// Route::get('/pengecekan/autocomplete','PengecekanController@autoComplete')->name('pengecekan.autocomplete');
Route::get('autocomplete','PengecekanController@autoComplete')->name('pengecekan.autocomplete');
Route::post('cetak/pengecekan','PengecekanController@cetak');

Route::get('showptsl', 'PengecekanController@showPtsl')->name('pengecekan.showptsl');

// Data Master Peminjaman
Route::resource('/peminjamanmaster', 'PeminjamanMasterController')->except(['create']);
Route::get('api/peminjamanmaster', 'PeminjamanMasterController@apipeminjamanmaster')->name('api.peminjamanmaster');


//Peminjaman
Route::resource('peminjaman/master','PeminjamanMasterController');
Route::get('api/peminjamanmaster','PeminjamanMasterController@apiPeminjamanMaster')->name('api.peminjaman.master');

Route::resource('peminjaman/master2','PeminjamanMasterController2');
// Route::get('api/peminjamanmaster2','PeminjamanMasterControlle2r@apiPeminjamanMaster');
Route::get('api/peminjamanmaster2','PeminjamanMasterController2@apiPeminjamanMaster');


Route::get('peminjamanmastercek','PeminjamanMasterController@cek');
Route::get('peminjamanmastercekpijam','PeminjamanMasterController@cekpinjam');
Route::get('peminjamanmastercekpijam2','PeminjamanMasterController@cekpinjam2');
Route::get('autocompletepeminjamanmaster', 'PeminjamanMasterController@autoCompletePeminjaman');
Route::get('autocompletepeminjamanmastershow', 'PeminjamanMasterController@autoCompletePeminjamanshow');


Route::get('peminjamanmasterwalboard', 'PeminjamanMasterWallboardController@index');
Route::get('api/peminjamanmasterwalboard', 'PeminjamanMasterWallboardController@apiPeinjamanMasterWarllboard');
Route::get('peminjamanmasterwallboardcekpijam', 'PeminjamanMasterWallboardController@cekpinjam');

Route::get('peminjaman/history','PeminjamanHistoryController@index');
Route::get('api/peminjamanhistory', 'PeminjamanHistoryController@apiPeminjamanHistory');
Route::get('peminjamanhistorycekpijam', 'PeminjamanHistoryController@cekpinjam');
Route::post('cetakhistorypeminjaman', 'PeminjamanHistoryController@cetak');

Route::resource('peminjaman/proses','PeminjamanProsesController');
Route::delete('peminjamandetail/proses/{id}', 'PeminjamanProsesController@destroydetail');
Route::get('peminjamandetail/proses/{id}', 'PeminjamanProsesController@roketdetail');
Route::get('api/peminjamanproses','PeminjamanProsesController@apiPeminjamanProses')->name('api.peminjaman.proses');
Route::get('api/peminjamanproses/{id}','PeminjamanProsesController@apiPeminjamanProsesDetail');

Route::get('autocompletepegawai','PeminjamanProsesController@autoCompletePegawai');
Route::get('autocompletepegawaishow','PeminjamanProsesController@autoCompletePegawaiShow');
Route::get('autocompletepeminjaman','PeminjamanProsesController@autoComplete')->name('peminjaman.proses.autocomplete');
Route::get('autocompletepeminjamanshow','PeminjamanProsesController@showData')->name('peminjaman.proses.autocomplete.show');

Route::get('peminjaman/cetak/peminjamanproses/{id}','PeminjamanProsesController@cetak');
Route::get('api/via', 'PeminjamanProsesController@getVia');
Route::get('peminjaman/roket/peminjamanproses/{id}', 'PeminjamanProsesController@roket');


Route::resource('peminjaman/kegiatan', 'PeminjamanKegiatanController')->only(['index','edit','update','store']);
Route::get('api/peminjamankegiatan', 'PeminjamanKegiatanController@apiPeminjamanKegiatan');
Route::get('api/peminjamankegiatan/{id}', 'PeminjamanKegiatanController@apiPeminjamanKegiatanDetail');
Route::get('peminjamankegiatancek', 'PeminjamanKegiatanController@cek');
Route::get('peminjamankegiatancekdetail', 'PeminjamanKegiatanController@cekdetail');
Route::get('peminjamankegiatandetail/{id}', 'PeminjamanKegiatanController@datadetail');
Route::patch('peminjamankegiatandetailupdate/{id}', 'PeminjamanKegiatanController@datadetailupdate');

Route::get('peminjaman/kontrol','PeminjamanKontrolController@index');
Route::get('api/kontrol', 'PeminjamanKontrolController@apiData');

Route::resource('peminjaman/tunggakan','PeminjamanTunggakanController');
Route::get('api/tunggakan', 'PeminjamanTunggakanController@apiData');
Route::get('tunggakancekdetail', 'PeminjamanTunggakanController@tunggakancekdetail');

//pengembalian
Route::resource('pengembalian','PengembalianController');
// Route::get('api/pengembalian','PengembalianController@apiPengembalian');
Route::get('api/pengembaliandetail','PengembalianController@apiPengembalianDetail');
// Route::get('pengembaliancek','PengembalianController@cek');
Route::get('pengembaliancekdetail','PengembalianController@cekdetail');

Route::resource('pengembalianhistory', 'PengembalianHistoryController');
Route::get('api/pengembalianhistory', 'PengembalianHistoryController@apiPengembalianHistory');
Route::get('pengembaliancekdetailhistory', 'PengembalianHistoryController@cekdetail');

// Pengembalian Wallboard
Route::resource('pengembalianwallboard', 'PengembalianWallboardController');
Route::get('api/pengembalianwallboard', 'PengembalianWallboardController@apiData');



//Penyerahan
Route::resource('penyerahan', 'PenyerahanProsesController');
Route::get('api/penyerahan', 'PenyerahanProsesController@apiPenyerahan');
Route::post('cetak/penyerahan', 'PenyerahanProsesController@cetak');
Route::post('cetak/penyerahanbox', 'PenyerahanProsesController@cetakbox');
Route::get('penyerahanprosesstatus', 'PenyerahanProsesController@penyerahanprosesstatus');


Route::resource('penyerahanloket', 'PenyerahanLoketController');
Route::get('api/penyerahanloket', 'PenyerahanLoketController@apiPenyerahan');
Route::get('api/penyerahanloketdetail/{id}', 'PenyerahanLoketController@apiDetail');
Route::get('kamera', 'PenyerahanLoketController@kamera');
Route::post('kamera', 'PenyerahanLoketController@kameraAksi');
Route::get('cetak/penyerahanloket/{id}', 'PenyerahanLoketController@cetak');

Route::get('penyerahanhistory', 'PenyerahanHistoryController@index');
Route::get('api/penyerahanhistory', 'PenyerahanHistoryController@apiPenyerahan');
Route::post('cetak/penyerahanhistory', 'PenyerahanHistoryController@cetak');




Route::resource('user', 'UserController');
Route::get('api/user','UserController@apiUser')->name('api.user');
Route::get('editprofile/{id}', 'UserController@editprofile');
Route::patch('editprofile/{id}', 'UserController@updateprofile');
Route::post('editprofile/cekusers', 'UserController@cekusers');

Route::resource('userrole', 'UserRoleController');
Route::get('api/userrole', 'UserRoleController@apidata');

Route::resource('userpermission', 'UserPermissionController');
Route::get('api/userpermission', 'UserPermissionController@apidata');


});


Route::get('storage/app/public/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});