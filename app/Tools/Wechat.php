<?php

namespace App\Tools;
use Illuminate\Support\Facades\Cache;

class Wechat
{
    /**
     * 获取Access_token
     * @return mixed
     */
        public  static function getAccessToken(){
//                Cache::flush();
//            $access_token = Cache::get('access_token');
//            if (empty($access_token)) {
                $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".env('WECHAT_APPID')."&secret=".env('WECHAT_APP_SECRET')."";
                $access_token = json_decode(file_get_contents($url),true)['access_token'];
//                Cache::put('access_token',7200);
//            }
            return $access_token;
        }

        /**
         * @param $type 素材类型
         * @param int $type_time  1=临时 2=永久
         * @return string
         */
        public static function Material_url($type,$type_time){
            $access_token = Wechat::getAccessToken();
            if($type_time == 1){
                $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$access_token."&type=".$type."";
            }else{
                $url = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=".$access_token."";
            }
            return $url;
        }
    /**
     * 获取用户信息
     * @param $xml_obj  xml
     * @return bool|string
     */
        public  static function getUserInfo($xml_obj){
            $access_token = self::getAccessToken();
            $user_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$xml_obj->FromUserName."&lang=zh_CN";
            return file_get_contents($user_url);
        }
}
