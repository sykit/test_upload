<?php
// use DB;
  function getListMonth(){
    $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    return $bulan;
  }
  function getListSbu(){
    $data = DB::connection("cashflow")->select("SELECT * from mscfg where inactive = '0'");
    if(!empty($data)){
      return $data;
    }else{
      return [];
    }
  }
  function getNMPMA(){
    $kdcfg = session()->get('kdcfg');
    $kdpma = session()->get('kdpma');
    $nik = session()->get('nik');
    // $data = DB::connection("cashflow")->select("SELECT nmpma from mspmb where kdcfg = '$kdcfg' and kdpma = '$kdpma'");
    $data = DB::connection("cashflow")->select("SELECT nmpma from mspmb where kdcfg = '$kdcfg' and kdpma = '$kdpma'");
    if(!empty($data)){
      return $data[0];
    }else{
      return [];
    }
  }
  function getDetailPMA($kdcfg,$kdpma){
    $data = DB::connection("cashflow")->select("SELECT nmpma from mspmb where kdcfg = '$kdcfg' and kdpma = '$kdpma'");
    if(!empty($data)){
      return $data[0];
    }else{
      return [];
    }
  }
  function getListMSPMB(){
    $kdcfg = session()->get('kdcfg');
    $kdpma = session()->get('kdpma');
    $data = DB::connection("cashflow")->select("SELECT * from mspmb where kdcfg = '$kdcfg' ");
    if(!empty($data)){
      return $data;
    }else{
      return [];
    }
  }
  function getIndustri(){
    $kdcfg = session()->get('kdcfg');
    $kdpma = session()->get('kdpma');
    $kdlogin = session()->get('kdlogin');
    $nik = session()->get('nik');

    // $data = DB::connection("cashflow")->select("CALL adi_pilih_industri('$kdcfg','$kdpma','$kdlogin','F')");
    $data = DB::connection("cashflow")->select("SELECT a.*,b.*,c.* FROM
      zusr a
      LEFT JOIN zpma AS b ON a.kdlogin = b.kdlogin
      LEFT JOIN industri AS c ON c.kdpma = b.kdpma AND c.kdcfg=b.kdcfg
      WHERE a.nik ='$nik' and b.kdcfg = '$kdcfg' and b.kdpma = '$kdpma'  ");
    if(!empty($data)){
      return $data;
    }else{
      return [];
    }
  }
  function getListIndustri(){
    $kdcfg = session()->get('kdcfg');
    $kdpma = session()->get('kdpma');
    $k_indus = session()->get('k_indus');
    $data = DB::connection("cashflow")->select("SELECT * from industri where kdcfg = '$kdcfg' and kdpma = '$kdpma'");
    if(!empty($data)){
      return $data;
    }else{
      return [];
    }
  }
  function getDetailIndustri($kdcfg,$kdpma,$k_indus){
    $data = DB::connection("cashflow")->select("SELECT * from industri where kdcfg = '$kdcfg' and kdpma = '$kdpma'and k_indus = '$k_indus'");
    // dd($data);
    if(!empty($data)){
      return $data[0]->n_indus;
    }else{
      return "-";
    }
  }
  function f_currency($value) {
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

  function checkZUSR($nik)
  {
    $data = DB::connection("cashflow")->select("SELECT * from zusr where nik = '$nik'");
    // dd($data);
    if(!empty($data)){
      return true;
    }else{
      return false;
    }
  }

  function getListKdcur(){
    $data = DB::connection("cashflow")->select("SELECT * from mscur ");
    if(!empty($data)){
      return $data;
    }else{
      return [];
    }
  }

  function switchDateYear($date){
    $arrDate = explode("-",$date);
    return $arrDate[2]."-".$arrDate[1]."-".$arrDate[0];
  }
  function switchDateYearJam($date){
    $date = explode(" ",$date)[0];
    $arrDate = explode("-",$date);
    return $arrDate[2]."-".$arrDate[1]."-".$arrDate[0];
  }

  function getDetailSBU($kdcfg){
    $data = DB::connection("cashflow")->select("SELECT * from mscfg where kdcfg = '$kdcfg'")[0];
    return $data;
  }

  function detailAnggaran($kdcfg,$kdpma,$tgltrs,$kdang){
    $arrtgltrs = explode('-',$tgltrs);
    $periode = ($arrtgltrs[0].$arrtgltrs[1]);
    $sbu = $kdcfg;
    $pma = $kdpma;
    $hasil = (object)[];
// dd("CALL adi_hitung_realisasi_percoa('$sbu','$periode','$kdang','$pma')");
    $realisasi = DB::connection('cashflow')->select("CALL adi_hitung_realisasi_percoa('$sbu','$periode','$kdang','$pma')");
    if(!empty($realisasi)){
      $hasil->realisasi =  $realisasi[0]->realisasi;
    }else{
      $hasil->realisasi = 0;
    }

      $budget = DB::connection('cashflow')->select("CALL adi_hitung_budget_percoa('$sbu','$periode','$kdang','$pma')");
      // dd("CALL adi_hitung_budget_percoa('$sbu','$periode','$kdang','$pma')");
      // dd($budget );
      if(!empty($budget)){
        $hasil->budget =  $budget[0]->hasil;
      }else{
        $hasil->budget = 0;
      }

    return $hasil;
  }

function terbilang($angka) {
   $angka=abs($angka);
   $baca =array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");

   $terbilang="";
    if ($angka < 12){
        $terbilang= " " . $baca[$angka];
    }
    else if ($angka < 20){
        $terbilang= terbilang($angka - 10) . " Belas";
    }
    else if ($angka < 100){
        $terbilang= terbilang($angka / 10) . " Puluh" . terbilang($angka % 10);
    }
    else if ($angka < 200){
        $terbilang= " Seratus" . terbilang($angka - 100);
    }
    else if ($angka < 1000){
        $terbilang= terbilang($angka / 100) . " Ratus" . terbilang($angka % 100);
    }
    else if ($angka < 2000){
        $terbilang= " Seribu" . terbilang($angka - 1000);
    }
    else if ($angka < 1000000){
        $terbilang= terbilang($angka / 1000) . " Ribu" . terbilang($angka % 1000);
    }
    else if ($angka < 1000000000){
       $terbilang= terbilang($angka / 1000000) . " Juta" . terbilang($angka % 1000000);
    }
       return $terbilang;
}
