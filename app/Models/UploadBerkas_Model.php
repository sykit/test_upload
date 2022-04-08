<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use GlobalHelper;
use File;

class UploadBerkas_Model extends Model
{
    public static function proses($request){
      $year;
      $month;
      $day = date('d');
      $year = date('Y');
      $month = date('m');
      $nama_barang = $request->nama_barang;
      $harga_barang = $request->harga_barang;
      $harga_jual = $request->harga_jual;
      $foto_barang = $request->foto_barang;
      $stok = $request->stok;
      $file_extension = $request->file('foto_barang')->extension();
      $file_asli = $request->file('foto_barang')->getClientOriginalName();
      $cekNama = DB::select("select nama_barang, foto_barang from data_berkas where nama_barang = '$nama_barang'");
      if (!empty($cekNama)) {
        return "1";
      }
  


      $data = DB::select("select max(foto_barang) as max from data_berkas where foto_barang like '$year$month%'");
      if (empty($data)) {
        $file_name = $year.$month."00001.".  $file_extension ;
      }else{
        $hasil = $data[0]->max;
        $number = substr($hasil,6,5);
        $file_name = $year.$month.sprintf("%05d", (String)((int)$number+1)).".".  $file_extension ;

      }
      // $request->file->extension();

      $data = DB::insert("INSERT INTO `data_berkas`
        	(`nama_barang`,
        	`harga_barang`,
        	`harga_jual`,
        	`stok`,
        	`foto_barang`,
        	`tgl_input`
        	)
        	VALUES
        	('$nama_barang',
        	'$harga_barang',
        	'$harga_jual',
        	'$stok',
        	'$file_name',
        	'$year-$month-$day'
        	)
          ");

      $file = $request->file('foto_barang');
      $tujuan_upload = 'file_data';
      $file->move($tujuan_upload,$file_name);


      return "0";
    }
    public static function edit($request){
      $year;
      $month;
      $day = date('d');
      $year = date('Y');
      $month = date('m');
      $nama_barang = $request->nama_barang;
      $harga_barang = $request->harga_barang;
      $harga_jual = $request->harga_jual;
      $foto_barang = $request->foto_barang;
      $stok = $request->stok;
      $id = $request->id;
      $cekNama = DB::select("select nama_barang, foto_barang from data_berkas where nama_barang = '$nama_barang' and id != '$id'");
      if (!empty($cekNama)) {
        return "1";
      }
      $cekData = DB::select("select * from data_berkas where id = '$id'");
      // dd($cekData);
      $id = $cekData[0]->id;

      if (!empty($request->foto_barang)) {
        File::delete('file_data/'.$cekData[0]->foto_barang);
        $file_extension = $request->file('foto_barang')->extension();
        $file_asli = $request->file('foto_barang')->getClientOriginalName();
        $data = DB::select("select max(foto_barang) as max from data_berkas where foto_barang like '$year$month%'");
        if (empty($data)) {
          $file_name = $year.$month."00001.".  $file_extension ;
        }else{
          $hasil = $data[0]->max;
          $number = substr($hasil,6,5);
          $file_name = $year.$month.sprintf("%05d", (String)((int)$number+1)).".".  $file_extension ;

        }
        $data = DB::update("UPDATE `data_berkas` set
          	`nama_barang`= '$nama_barang',
          	`harga_barang`= '$harga_barang',
          	`harga_jual`= '$harga_jual',
          	`stok`= '$stok',
          	`foto_barang`= '$file_name'
            where id = '$id'
          	");

        $file = $request->file('foto_barang');
        $tujuan_upload = 'file_data';
        $file->move($tujuan_upload,$file_name);
      }else{
        $data = DB::update("UPDATE `data_berkas` set
            `nama_barang`= '$nama_barang',
            `harga_barang`= '$harga_barang',
            `harga_jual`= '$harga_jual',
            `stok`= '$stok',
            where id = '$id'
            ");
      }


      // $request->file->extension();




      return "0";
    }

    public static function hapus($request){


      $data = DB::select("select * from data_berkas where id ='$request->id' ")[0];
      File::delete('file_data/'.$data->foto_barang);
      $data = DB::delete("delete from data_berkas where id ='$request->id' ");



      return '0';
    }


}
