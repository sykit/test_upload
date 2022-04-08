<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class Main_Controller extends Controller
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
    return view('main.index',compact('year','month'));
  }

}
