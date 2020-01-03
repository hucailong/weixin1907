<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    //素材添加
    public function add(){
        return view('media\add');
    }


    public function show(){
        return view('media\show');
    }
}
