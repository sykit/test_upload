<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\CariBerkas_Model;

class CariBerkas_Controller extends Controller
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

    return view('cari_berkas.index',compact('year','month'));
  }

  public function proses(Request $request)
  {
    $hasil = CariBerkas_Model::proses($request);
    return json_encode($hasil);
  }
  public function detail(Request $request)
  {
    $hasil = CariBerkas_Model::detail($request);
    return json_encode($hasil);
  }


}
