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

//Peminjaman
Route::resource('peminjaman/master','PeminjamanMasterController');
Route::get('peminjamanmaster/cek','PeminjamanMasterController@cek');
Route::get('api/peminjamanmaster','PeminjamanMasterController@apiPeminjamanMaster')->name('api.peminjaman.master');

Route::resource('peminjaman/proses','PeminjamanProsesController');
Route::delete('peminjamandetail/proses/{id}', 'PeminjamanProsesController@destroydetail');
Route::get('api/peminjamanproses','PeminjamanProsesController@apiPeminjamanProses')->name('api.peminjaman.proses');
Route::get('api/peminjamanproses/{id}','PeminjamanProsesController@apiPeminjamanProsesDetail');
Route::get('autocompletepegawai','PeminjamanProsesController@autoCompletePegawai');
Route::get('autocompletepegawaishow','PeminjamanProsesController@autoCompletePegawaiShow');
Route::get('autocompletepeminjaman','PeminjamanProsesController@autoComplete')->name('peminjaman.proses.autocomplete');
Route::get('autocompletepeminjamanshow','PeminjamanProsesController@showData')->name('peminjaman.proses.autocomplete.show');
Route::get('peminjaman/cetak/peminjamanproses/{id}','PeminjamanProsesController@cetak');

//pengembalian
Route::resource('pengembalian','PengembalianController');
Route::get('api/pengembalian','PengembalianController@apiPengembalian');
Route::get('api/pengembalian/{id}','PengembalianController@apiPengembalianDetail');
Route::get('pengembaliancek','PengembalianController@cek');
Route::get('pengembaliancekdetail','PengembalianController@cekdetail');


//user
Route::resource('user', 'UserController');
Route::get('api/user','UserController@apiUser')->name('api.user');

