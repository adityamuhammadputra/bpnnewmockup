<?php
Route::get('/', function () {
    return view('welcome');
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

Route::get('peminjamanmasterwalboard', 'PeminjamanMasterWallboardController@index');
Route::get('api/peminjamanmasterwalboard', 'PeminjamanMasterWallboardController@apiPeinjamanMasterWarllboard');
Route::get('peminjamanmasterwallboardcekpijam', 'PeminjamanMasterWallboardController@cekpinjam');

Route::get('peminjaman/history','PeminjamanHistoryController@index');
Route::get('api/peminjamanhistory', 'PeminjamanHistoryController@apiPeminjamanHistory');
Route::get('peminjamanhistorycekpijam', 'PeminjamanHistoryController@cekpinjam');

Route::resource('peminjaman/proses','PeminjamanProsesController');
Route::delete('peminjamandetail/proses/{id}', 'PeminjamanProsesController@destroydetail');
Route::get('api/peminjamanproses','PeminjamanProsesController@apiPeminjamanProses')->name('api.peminjaman.proses');
Route::get('api/peminjamanproses/{id}','PeminjamanProsesController@apiPeminjamanProsesDetail');
Route::get('autocompletepegawai','PeminjamanProsesController@autoCompletePegawai');
Route::get('autocompletepegawaishow','PeminjamanProsesController@autoCompletePegawaiShow');
Route::get('autocompletepeminjaman','PeminjamanProsesController@autoComplete')->name('peminjaman.proses.autocomplete');
Route::get('autocompletepeminjamanshow','PeminjamanProsesController@showData')->name('peminjaman.proses.autocomplete.show');
Route::get('peminjaman/cetak/peminjamanproses/{id}','PeminjamanProsesController@cetak');
Route::get('api/via', 'PeminjamanProsesController@getVia');


Route::resource('peminjaman/kegiatan', 'PeminjamanKegiatanController')->only(['index','edit','update']);
Route::get('api/peminjamankegiatan', 'PeminjamanKegiatanController@apiPeminjamanKegiatan');
Route::get('api/peminjamankegiatan/{id}', 'PeminjamanKegiatanController@apiPeminjamanKegiatanDetail');
Route::get('peminjamankegiatancek', 'PeminjamanKegiatanController@cek');
Route::get('peminjamankegiatancekdetail', 'PeminjamanKegiatanController@cekdetail');
Route::get('peminjamankegiatandetail/{id}', 'PeminjamanKegiatanController@datadetail');
Route::patch('peminjamankegiatandetailupdate/{id}', 'PeminjamanKegiatanController@datadetailupdate');








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








//user
Route::resource('user', 'UserController');
Route::get('api/user','UserController@apiUser')->name('api.user');

