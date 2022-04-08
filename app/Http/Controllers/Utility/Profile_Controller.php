<?php

namespace App\Http\Controllers\Utility;

use Illuminate\Http\Request;
use Validator;

class Profile_Controller extends Controller
{
  public function index(Request $request)
  {

    return view('utility.profile');

  }

  public function data(Request $request)
  {
    $data = TransaksiBerlangganan_Model::getData($request);
    return json_encode($data);
  }

  public function detail(Request $request)
  {
    $data = TransaksiBerlangganan_Model::detail($request);
    return json_encode($data);
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
    $data = TransaksiBerlangganan_Model::editSimpan($request, $user,$waktu);
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
    $data = TransaksiBerlangganan_Model::tambahSimpan($request, $user,$waktu);
    return back()->with('success','Agen berhasil di tamabahkan');;
  }
  public function hapus(Request $request)
  {
    $user = session()->get('username');
    $waktu = date("Y-m-d H:i:s");
    $data = TransaksiBerlangganan_Model::hapus($request,$user,$waktu);
    return back()->with('success','Agen berhasil di batalkan !');
  }

}
