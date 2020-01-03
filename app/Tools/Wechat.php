<?php

namespace App\Tools;
use Illuminate\Support\Facades\Cache;

class Wechat
{
        public  static function getAccessToken(){
            Cache::flush();
        }

    /**
     * @param $xml_obj  xml
     * @return bool|string
     */
        public  static function getUserInfo($xml_obj){
            $access_token = self::getAccessToken();

            $user_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$xml_obj->FromUserName."&lang=zh_CN";
            return file_get_contents($user_url);
        }
}
