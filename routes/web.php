<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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
Route::get('showptsl', 'PengecekanController@showPtsl')->name('pengecekan.showptsl');

//Peminjaman
Route::resource('peminjaman/master','PeminjamanMasterController');
Route::get('peminjamanmaster/cek','PeminjamanMasterController@cek');
Route::get('api/peminjamanmaster','PeminjamanMasterController@apiPeminjamanMaster')->name('api.peminjaman.master');

Route::resource('peminjaman/proses','PeminjamanProsesController');
Route::get('api/peminjamanproses','PeminjamanProsesController@apiPeminjamanProses')->name('api.peminjaman.proses');
Route::get('autocompletepeminjaman','PeminjamanProsesController@autoComplete')->name('peminjaman.proses.autocomplete');
Route::get('autocompletepeminjamanshow','PeminjamanProsesController@showData')->name('peminjaman.proses.autocomplete.show');





//user
Route::resource('user', 'UserController');
Route::get('api/user','UserController@apiUser')->name('api.user');

