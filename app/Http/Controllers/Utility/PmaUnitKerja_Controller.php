<?php

namespace App\Http\Controllers\Utility;

use Illuminate\Http\Request;
use App\User;
use App\Model\Utility\PmaUnitKerja_Model;
use Illuminate\Support\Facades\Storage;
use Validator;

class PmaUnitKerja_Controller extends Controller
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

    return view('utility.pma_unit_kerja.index',compact('year','month'));
  }

  public function simpan(Request $request)
  {
    // dd($request->all());
    $validator = Validator::make($request->all(), [
       'kdcfg' => 'required',
       'kdpma' => 'required',
       'industri' => 'required',
    ]);

    if ($validator->fails()) {
        return back()->with('error','Data tidak boleh kosong !');
    }



    PmaUnitKerja_Model::simpanData($request);

    return back()->with('success','Data berhasil di simpan');
  }


}
