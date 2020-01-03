<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
class IndexController extends Controller
{

    public function index(){
        return view('hadmin.index');
    }

    public function index_v1(){
        return view('hadmin.index_v1');
    }
}
