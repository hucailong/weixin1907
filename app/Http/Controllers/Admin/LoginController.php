<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
class LoginController extends Controller
{
    public function login(){
        return view('login.login');
    }

    public function login_do(){
        $data = request()->except('_token');
//        dd($data);
        $user = User::where($data)->first();
//        dd($user);
        if ($user) {
            session(['user' => $user]);
            request()->session()->save();
            return redirect('/admin/index');
        }else{
            echo "<script>alert('密码或账号错误');location.href='/index.php/admin/login';</script>";
        }

    }
    public function index(){
        return view('hadmin.index');
    }

    public function index_v1(){
        return view('hadmin.index_v1');
    }
}
