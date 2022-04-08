<?php

namespace App\Http\Controllers\Utility;

use Illuminate\Http\Request;
use App\Model\Utility\User_Model;
use Validator;

class User_Controller extends Controller
{
  public function index(Request $request)
  {

    return view('utility.user.index');

  }

  public function data(Request $request)
  {
    $data = User_Model::getData($request);
    return json_encode($data);
  }

  public function detail(Request $request)
  {
    $data = User_Model::detail($request);
    return view('utility.user.profile',compact('data'));
  }

  public function editSimpan(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'kd_agen' => 'required',
        'nm_agen' => 'required',
    ]);

    if ($validator->fails()) {
        return back()->with('error','No Agen / Nama Agen Digital tidak boleh kosong !');
    }

    $user = session()->get('username');
    $waktu = date("Y-m-d H:i:s");
    $data = User_Model::editSimpan($request, $user,$waktu);
    return back()->with('success','Data berhasil di simpan');;
  }
  public function tambahSimpan(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'nm_agen' => 'required',
    ]);

    if ($validator->fails()) {
        return back()->with('error','Nama Agen Digital tidak boleh kosong !');
    }

    $user = session()->get('username');
    $waktu = date("Y-m-d H:i:s");
    $data = User_Model::tambahSimpan($request, $user,$waktu);
    return back()->with('success','Agen berhasil di tamabahkan');;
  }
  public function hapus(Request $request)
  {
    $user = session()->get('username');
    $waktu = date("Y-m-d H:i:s");
    $data = User_Model::hapus($request,$user,$waktu);
    return back()->with('success','Akses user berhasil di hapus !');
  }

  public function tambahWhitelist(Request $request)
  {
    if (empty($request->id)) {
      return back()->with('error','NIK Tidak Boleh Kosong !');
    }
    $user = session()->get('username');
    $waktu = date("Y-m-d H:i:s");
    $data = User_Model::tambahWhitelist($request,$user,$waktu);
    // dd($data);
    if ($data == '0') {
      return back()->with('success','User berhasil di Tambahkan !');
    }elseif ($data == '1') {
      return back()->with('error','User sudah terdaftar !');
    }elseif ($data == '2') {
      return back()->with('error','Tidak ditemukan Karyawan dengan NIK : '.$request->id.' atau karyawan sudah keluar');

    }else{
      return back()->with('error','Error belum terdefinisi !');

    }
  }

  public function aktifkan(Request $request)
  {
    $user = session()->get('username');
    $waktu = date("Y-m-d H:i:s");
    $data = User_Model::aktifkan($request,$user,$waktu);
    return back()->with('success','User Berhasil di Aktifkan !');
  }
  public function matikan(Request $request)
  {
    $user = session()->get('username');
    $waktu = date("Y-m-d H:i:s");
    $data = User_Model::matikan($request,$user,$waktu);
    return back()->with('success','User Berhasil di Matikan !');
  }

}
