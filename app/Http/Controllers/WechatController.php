<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WechatController extends Controller
{
    public function wechat(){
        echo  request()->get('echostr');
    }
}
