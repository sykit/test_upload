<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });
// Route::get('/login','App\Http\Controllers\User_Controller@login')->name('User.Login');
Route::get('/',  function () {
    return view('index');
});


Route::get('/user_logout','App\Http\Controllers\User_Controller@logout');

Route::get('/user_login','App\Http\Controllers\User_Controller@login')->name('User.Login');

Route::get('cari_berkas','App\Http\Controllers\CariBerkas_Controller@index');
Route::get('cari_berkas/proses','App\Http\Controllers\CariBerkas_Controller@proses');
Route::get('cari_berkas/detail/{id}','App\Http\Controllers\CariBerkas_Controller@detail');
Route::get('upload_berkas','App\Http\Controllers\UploadBerkas_Controller@index');
Route::get('upload_berkas/{id}','App\Http\Controllers\UploadBerkas_Controller@index2');
Route::post('upload_berkas/proses','App\Http\Controllers\UploadBerkas_Controller@proses');
Route::post('upload_berkas/edit','App\Http\Controllers\UploadBerkas_Controller@edit');
Route::post('upload_berkas/{id}/proses','App\Http\Controllers\UploadBerkas_Controller@proses');
Route::get('upload_berkas/hapus/{id}','App\Http\Controllers\UploadBerkas_Controller@hapus');
