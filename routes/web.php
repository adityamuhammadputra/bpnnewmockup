<?php
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
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
Route::get('peminjamanmastercek','PeminjamanMasterController@cek');
Route::get('peminjamanmastercekpijam','PeminjamanMasterController@cekpinjam');
Route::get('api/peminjamanmaster','PeminjamanMasterController@apiPeminjamanMaster')->name('api.peminjaman.master');
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








//user
Route::resource('user', 'UserController');
Route::get('api/user','UserController@apiUser')->name('api.user');

