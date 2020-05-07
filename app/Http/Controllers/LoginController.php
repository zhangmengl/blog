<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Contracts\Encryption\DecryptException;
class LoginController extends Controller
{
    public function loginDo(){
        $admin=request()->except("_token");
        $res=Admin::where("admin_name",$admin["admin_name"])->first();
        if($res["admin_pwd"]!=$admin["admin_pwd"]){
            return redirect("/login")->with("msg","用户名或密码错误！");
        }
        session(['admin_name'=>$res]);
        return redirect("/alien/index");
    }
}
