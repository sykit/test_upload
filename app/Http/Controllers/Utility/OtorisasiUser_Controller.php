<?php

namespace App\Http\Controllers\Utility;

use Illuminate\Http\Request;
use App\User;
use App\Model\Utility\OtorisasiUser_Model;

class OtorisasiUser_Controller extends Controller
{
  public function index(Request $request)
  {
    $year;
    $month;
    if(!empty($request->year)&&!empty($request->month)){
      $year = $request->year;
      $month = $request->month;
    }else{
      $year = date('Y');
      $month = date('m');
    }

    return view('utility.otorisasi_user.index',compact('year','month'));
  }

  public function detail(Request $request)
  {
    $year;
    $month;
    if(!empty($request->year)&&!empty($request->month)){
      $year = $request->year;
      $month = $request->month;
    }else{
      $year = date('Y');
      $month = date('m');
    }
    $user = OtorisasiUser_Model::detailUser($request);
    if ($user == '1') {
      return back()->with('error', "user tersebut tidak memiliki otorisasi !!");
    }
    $list = OtorisasiUser_Model::listOtoritas($request);
    if ($list == '1') {
      return back()->with('error', "user tersebut tidak memiliki otorisasi !!");
    }
    return view('utility.otorisasi_user.detail',compact('year','month','user','list'));
  }

  public function data(Request $request)
  {
    $hasil = OtorisasiUser_Model::proses($request);
    return json_encode($hasil);
  }
  public function proses(Request $request)
  {
    $hasil = OtorisasiUser_Model::proses($request);
    return json_encode($hasil);
  }




}
