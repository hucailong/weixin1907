<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WechatController extends Controller
{

    private $stu_arr = ['刘清源','文安生','商业兴','度国伟','阿龙','高泽东','王振国'];


    public function wechat(){
        //echo  request()->get('echostr');

        $xml = file_get_contents('php://input');
        file_put_contents('xml.log',date("Y-m-d H:i:s").$xml,8);
        $xml_obj = simplexml_load_string($xml); //
        file_put_contents('xml_obj.log',$xml,8);
       //关注推送

        if ($xml_obj->MsgType == 'event' && $xml_obj->Event == 'subscribe') {
            $this -> Text_response($xml_obj,'谢谢关注');
        }


        //文本回复
        if ($xml_obj->MsgType == 'text' ) {
            $content = $xml_obj ->Content;
            //用户发送1 展示全班所有同学姓名
            // 发送2 回复本班最帅同学姓名
            // 发送天气 回复北京当前一周天气
            $arr = $this ->stu_arr;
            if ($content == '1') {
                $str = '1907同学:'.implode(',',$arr);
                $this -> Text_response($xml_obj,$str);
            }elseif ($content == '2' ) {
                shuffle($arr);
                $str = '最帅同学:'.$arr[0];
                $this -> Text_response($xml_obj,$str);
            }elseif (mb_strpos(trim($content),'天气') !== false ) {
                $city = rtrim($content,"天气"); //获取指定城市天气
                $weather = $this ->botain_weather($city);
                $this -> Text_response($xml_obj,$weather);
            }else{
                $this -> Text_response($xml_obj,$content);
            }
        }
    }


    /**
     * 文本回复
     * @param $xml_obj xml对象
     * @param $msg 回复消息
     */
    public function Text_response($xml_obj,$msg){
        echo "<xml>
      <ToUserName><![CDATA[".$xml_obj->FromUserName."]]></ToUserName>
        <FromUserName><![CDATA[".$xml_obj->ToUserName."]]></FromUserName>
      <CreateTime>".time()."</CreateTime>
        <MsgType><![CDATA[text]]></MsgType>
          <Content><![CDATA[".$msg."]]></Content>
          </xml>";
    }

    /**
     * 获取指定城市天气
     * @param string $city 城市
     */
    public function botain_weather($city)
    {
        if(empty($city)){
            $city ="北京";
        }
        $url = "http://api.k780.com/?app=weather.future&weaid=".$city."&&appkey=47880&sign=45784aa64359d091fa851a1c1df6297b&format=json";
        $data = file_get_contents($url);
        $data_city = json_decode($data, true);
        //    var_dump($data_city);
        $msg = "";
        foreach ($data_city['result'] as $k => $v) {
            $msg .= $v['days']." ".$v['week']." ".$v['citynm']." ".$v['temperature']." " .$v['weather']."\n";
        }
        return $msg;
    }
}
