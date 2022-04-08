<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use GlobalHelper;

class CariBerkas_Model extends Model
{
    public static function proses($request){

      $deskripsi = $request->deskripsi;
      $data = DB::select("select * from data_berkas where (nama_barang like '%$deskripsi%')   ");



      return $data;
    }
    public static function detail($request){

      $id = $request->id;
      $data = DB::select("select * from data_berkas where id = '$id'");



      return $data[0];
    }




}
