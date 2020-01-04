<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tools\Wechat;
use App\Tools\Curl;
use App\Wechat\Media;
class MediaController extends Controller
{
    //素材添加
    public function add(){
        return view('media/add');
    }
    //执行添加
    public function add_do(Request $request){
        //接值
        $data = $request->input();
//        var_dump($data);
//        exit;
        //文件上传
        $file = $request->datum;

        if (!$request->hasFile('datum')) {
            echo "报错";exit;
        }
        $ext = $file->getClientOriginalExtension();
        $filename = md5(uniqid()).".".$ext;
        $Path = $file->storeAs("WechatMedia/".$data['media_format'],$filename);
        //素材添加接口
        $access_token = Wechat::getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$access_token."&type=".$data['media_format']."";
        $filePath = new \CURLFile(public_path()."/".$Path);
//        var_dump($filePath);exit;
        $postData = ['media'=>$filePath];
        $media_id = json_decode(Curl::Post($url,$postData),true)['media_id'];
        Media::create([
            'media_name'    =>  $data['media_name'],
            'media_format'  =>  $data['media_format'],
            'media_type'  =>  $data['media_type'],
            'media_path'  =>    $Path,
            'wechat_media_id'  => $media_id,
            'add_time'  => time() ,
            'over_time' => time() +(60*60*24*3) ,
        ]);
    }


    public function show(){
        $data = Media::get()->toArray();
        return view('media\show',['data' => $data]);
    }
}
