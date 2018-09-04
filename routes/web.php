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
Route::resource('bukutanah', 'BukutanahController');
Route::get('api/bukutanah','BukutanahController@apiBukuTanah')->name('api.bukutanah');
Route::resource('peminjamanloket', 'PeminjamanLoketController');
Route::get('api/peminjamanloket','PeminjamanLoketController@apiPeminjamanLoket')->name('api.PeminjamanLoket');



// Route::get('layananloket', 'LayananloketController@index')->name('bukutanah.index');

//user
Route::resource('user', 'UserController');
Route::get('api/user','UserController@apiUser')->name('api.user');

