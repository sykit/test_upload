<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\UploadBerkas_Model;
use Illuminate\Support\Facades\Storage;
use Validator;

class UploadBerkas_Controller extends Controller
{


  public function proses(Request $request)
  {

    $validator = Validator::make($request->all(), [
       'nama_barang' => 'required',
       'harga_barang' => 'required',
       'harga_jual' => 'required',
       'foto_barang' => 'required',
       'stok' => 'required',
    ]);

    if ($validator->fails()) {
        return back()->with('error','Input tidak boleh kosong !');
    }
    // dd($request->all());
    $file_extension = $request->file('foto_barang')->extension();
    if ($file_extension != "jpg" && $file_extension != "png") {
      return back()->with('error','format file tidak sesuai');
    }

    $hasil = UploadBerkas_Model::proses($request);
    if ($hasil == '1') {
      return back()->with('error','Nama Barang Telah Digunakan !');

    }else{
      return back()->with('success','Data berhasil di simpan');

    }

  }
  public function edit(Request $request)
  {

    $validator = Validator::make($request->all(), [
       'nama_barang' => 'required',
       'harga_barang' => 'required',
       'harga_jual' => 'required',
       'stok' => 'required',
    ]);

    if ($validator->fails()) {
        return back()->with('error','Input tidak boleh kosong !');
    }
    // dd($request->all());
    if (!empty($request->foto_barang)) {
      $file_extension = $request->file('foto_barang')->extension();
      if ($file_extension != "jpg" && $file_extension != "png") {
        return back()->with('error','format file tidak sesuai');
      }
    }


    $hasil = UploadBerkas_Model::edit($request);
    if ($hasil == '1') {
      return back()->with('error','Nama Barang Telah Digunakan !');

    }else{
      return back()->with('success','Data berhasil di simpan');

    }

  }


  public function hapus(Request $request)
  {
    $hasil = UploadBerkas_Model::hapus($request);
    return json_encode($hasil);
  }
}
