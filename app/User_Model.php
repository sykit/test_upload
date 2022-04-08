<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;
use Session;
use App\Model\Utility\Log_Model;

class User_Model extends Authenticatable
{
    public static function login($request){
      $username = $request->username;
      // $password = md5($request->password);
      // $user = DB::select("select * from users where username = '$username' and password = Password('$request->password')");
      $user = DB::connection('mysql_barter')->select("select * from ms00_login where login = '$username' and pswd = Password('$request->password')");

        if(empty($user)){
          return "2";
        }else{
          $nik = $user[0]->nik;
          $username = $user[0]->login;
          $email = $user[0]->email;
          $password = $user[0]->pswd;

          $whitelist = DB::select("select * from sys01_whitelist where nik = '$nik' ");
          if(empty($whitelist)){
            return "3";
          }else if ($whitelist[0]->flag_aktif != '1') {
            return "4";
          }


          Log_Model::saveLog($nik);
          $user_local = DB::select("select * from users where nik = '$nik'");
          if(empty($user_local)){
            DB::insert("INSERT INTO `users`(`nik`, `email`, `username`, `password`, `role_id`) VALUES ('$nik','$email','$username','$password','0')");
            $role_id = '0';
          }else{
            DB::update("UPDATE `users` SET `email`='$email',`username`='$username',`password`='$password' WHERE `nik`='$nik'");
            $role_id = $user_local[0]->role_id;

          }
          // session(['id' => $user[0]->id]);
          session(['nik' => $nik]);
          // session(['nik' => 'T1271']);
          session(['username' => $user[0]->login]);
          session(['fullname' => $whitelist[0]->nama]);

          session(['email' => $user[0]->email]);
          session(['role_id' => $role_id]);
          session(['login' => true]);

          $setup = DB::select("select * from last_user_setup where nik = '$nik'");
          if (!empty($setup)) {
            session(['kdcfg' => $setup[0]->kdcfg]);
            session(['kdpma' => $setup[0]->kdpma]);
            // session(['k_indus' => $setup[0]->industri]);
            session(['k_indus' => $setup[0]->industri]);
            session(['kdlogin' => $setup[0]->kdlogin]);
          }
          $data = DB::connection("cashflow")->select("SELECT * from zusr where nik = '$nik'");
          // dd($data);
          if(!empty($data)){
            session(['has_otorisasi' => true]);
          }else{
            session(['has_otorisasi' => false]);

          }


          return "1";
        }

    }
    public static function logout(){
      // session()->dest
      // Auth::logout();
      Session::flush();
      return;
    }





    // use Notifiable;
    //
    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];
    //
    // /**
    //  * The attributes that should be hidden for arrays.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    //
    // /**
    //  * The attributes that should be cast to native types.
    //  *
    //  * @var array
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
