<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
class LoginController extends Controller
{
    public function login(){
        return view('admin.login');
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
        return view('admin.index');
    }

    public function index_v1(){
        return view('admin.index_v1');
    }
}
