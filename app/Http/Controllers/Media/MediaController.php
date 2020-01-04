<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tools\Wechat;
use App\Tools\Curl;

class MediaController extends Controller
{
    //素材添加
    public function add(){
        return view('media/add');
    }

    public function add_do(Request $request){
        $type = "image";
        $file = $request->datum;
        if (!$request->hasFile('datum')) {
            echo "报错";exit;
        }
        $filePath = $file->store($type);
        $access_token = Wechat::getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$access_token."&type=".$type."";
        $filePath = new \CURLFile(public_path()."/".$filePath);
//        var_dump($filePath);exit;
        $postData = ['media'=>$filePath];
        var_dump($postData);exit;   
        $output = Curl::Post($url,$postData);
        var_dump($output);
    }


    public function show(){
        return view('media\show');
    }
}
