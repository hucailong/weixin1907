<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tools\Wechat;
use APP\Tools\Curl; 

class MediaController extends Controller
{
    //素材添加
    public function add(){
        return view('media/add');
    }

    public function add_do(Request $request){
        $type = "images";
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
        $output = Curl::Post($url,$postData);
//        $curl = curl_init();
//        curl_setopt($curl, CURLOPT_URL, $url);//设置请求地址
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//返回数据格式
//        curl_setopt($curl, CURLOPT_POST, 1); //设置成post请求
//        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);//设置post传输数据
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//关闭https验证
//        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);//关闭https验证
//        $output = curl_exec($curl);
//        curl_close($curl);
        var_dump($output);
    }


    public function show(){
        return view('media\show');
    }
}
