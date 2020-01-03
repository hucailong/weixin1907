<?php

namespace App\Tools;
use Illuminate\Support\Facades\Cache;

class Wechat
{
        public  static function getAccessToken(){
            $access_token = Cache::get('access_token');
            if (empty($access_token)) {
                $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".env('WECHAT_APPID')."&secret=".env('WECHAT_APP_SECRET')."";
                $access_token = json_decode(file_get_contents($url),true)['access_token'];
                Cache::put('access_token',$access_token);
            }
            return $access_token;
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
