<?php
namespace App\Helpers;
use DB;


class GlobalHelper {
  public static function getListMonth(){
    $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    return $bulan;
  }

  public static function getListSbu(){
    $data = DB::select("SELECT * from mscfg where inactive = '0'");
    if(!empty($data)){
      return $data;
    }else{
      return [];
    }
  }
  public static function getListMSPSB(){
    $data = DB::select("SELECT * from mspsb ");
    if(!empty($data)){
      return $data;
    }else{
      return [];
    }
  }

  public static function getNameKgrup($string){
    $data = DB::select("SELECT n_grup from ms_kategori_nota where k_grup = '$string'");
    if(!empty($data)){
      return $data[0]->n_grup;
    }else{
      return "";
    }
  }

  public static function getSaldoPiutangPerSbu($year,$month,$sub){
    $data = DB::connection("mysql_piutang")->select("CALL dk_get_umur_piutang_sub('$year','1','$sub')");
    $param = "b_".$month;
    if(!empty($data)){
      return $data[0]->$param;
    }else{
      return "";
    }
  }

  public static function getDetailBMLangganan($string){
    $data = DB::select("SELECT * from tx_dbm_lg where no_bm = '$string'");
    if(!empty($data)){
      return $data;
    }else{
      return [];
    }
  }


  public static function switchDateYear($date){
    $arrDate = explode("-",$date);
    return $arrDate[2]."-".$arrDate[1]."-".$arrDate[0];
  }


  public static function f_currency($value) {
      $minus = explode('-',  $value);
      $retunValue="";
      $retunValueMinus="";
      if (count($minus) == '2') {
        $retunValueMinus="-";
        $value = $minus[1];
      }
      $value = explode('.',  $value)[0];
      $maskIndex = 3;
      for($i = strlen($value); $i>0; $i--){
          if($maskIndex == 0){
            $maskIndex = 2;
              $retunValue = ",".$retunValue;
          }else{
            $maskIndex--;
          }
          $retunValue= substr($value,$i-1,1).$retunValue;
      }
      return $retunValueMinus.$retunValue;
  }

  public static function separatorCurrency($value)
  {
    // $value=strrev($value);
    $value2 = explode('.',  $value)[0];
    $retunValue = "";
    $maskIndex = 3;
    $minus = false;

    if (!empty(explode('-',  $value2)[1])) {
      $minus = true;
      $value2 = explode('-',  $value2)[1];
    }

    for ($i = strlen($value2); $i > 0; $i--) {
      if ($maskIndex == 0) {
        $maskIndex = 2;
        // if(i != 0){
        $retunValue = "." . $retunValue;
        // }

      } else {
        $maskIndex--;
      }

      $retunValue = substr($value2, $i - 1, 1) . $retunValue;
      // $retunValue= $i.$retunValue;

    }
    if ($minus) {
      $retunValue = "-" . $retunValue;
    }
    if (!empty(explode('.',  $value)[1])) {
      $retunValue = $retunValue . "," . explode('.',  $value)[1];
    } else {
      $retunValue = $retunValue;
    }
    return $retunValue;
  }
  public static function convertThousand($value)
  {
    $number = $value / 1000000;
    if ($number >= 0) {
      return $newVal = self::separatorCurrency(floor($number));
    }else{
    return $newVal = self::separatorCurrency(ceil($number));
    }
    // return $newVal = self::separatorCurrency(floor($number));
    // return $newVal = floor($number);
    // return $newVal = $number;
  }
}
