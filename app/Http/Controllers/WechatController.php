<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\Wechat;
use App\Wechat\Report;
use Illuminate\Support\Facades\Cache;
class WechatController extends Controller
{

    private $stu_arr = ['刘清源','文安生','商业兴','度国伟','阿龙','高泽东','王振国'];

    //微信接入
    public function wechat(){
        //echo  request()->get('echostr');

        $xml = file_get_contents('php://input');
        file_put_contents('xml.log',date("Y-m-d H:i:s").$xml,8);//写入日志
        $xml_obj = simplexml_load_string($xml); //

       //关注推送
        if ($xml_obj->MsgType == 'event' && $xml_obj->Event == 'subscribe') {
            //获取用户信息
            $userInfo = Wechat::getUserInfo($xml_obj);
            $userInfo_arr = json_decode($userInfo,true);
            $msg = "欢迎".$userInfo_arr['nickname'].($userInfo_arr['sex']==1?'先生':'女士')."关注本公众号.";
            $this -> Text_response($xml_obj,$msg);
        }

        //文本回复
        if ($xml_obj->MsgType == 'text' ) {
            $content = $xml_obj ->Content;
            //用户发送1 展示全班所有同学姓名
            // 发送2 回复本班最帅同学姓名
            // 发送天气 回复北京当前一周天气
            $arr = $this ->stu_arr;
            if ($content == trim('1')) {
                $str = '1907同学:'.implode(',',$arr);
                $this -> Text_response($xml_obj,$str);
            }elseif ($content == trim('2') ) {
                shuffle($arr);
                $str = '最帅同学:'.$arr[0];
                $this -> Text_response($xml_obj,$str);
            }elseif (mb_strpos(trim($content),'天气') !== false ) {
                $city = rtrim($content,"天气"); //获取指定城市天气
                $weather = $this ->botain_weather($city);
                $this -> Text_response($xml_obj,$weather);
            }else if($content == trim('最新新闻')) {

                $reportInfo = Report::orderBy('report_id', 'desc')->first();
                $report_sum = Cache::increment($reportInfo['report_title']);
                Report::where('report_id',$reportInfo->report_id)->update(['report_sum'=>$report_sum]);

                $content = "新闻>\n标题:".$reportInfo['report_title']."内容:".$reportInfo['report_content']."\n作者:".$reportInfo['report_author']."\n发布时间:".$reportInfo['report_time']."\n点击量:".$reportInfo['report_sum']."";
                $this->Text_response($xml_obj, $content);
            }else if($content == trim(('新闻'.$content))){

                $reportInfo = Report::where('report_title',$content )->first();
                $content = "新闻>\n标题:".$reportInfo['report_title']."内容:".$reportInfo['report_content']."\n作者:".$reportInfo['report_author']."\n发布时间:".$reportInfo['report_time']."\n点击量:".$reportInfo['report_sum']."";
                $this->Text_response($xml_obj, $content);
            }
//            }else{
//                $this -> Text_response($xml_obj,$content);
//            }



        }

        //斗图
//        if($xml_obj->MsgType == "image") {
//            $this -> Image_response($xml_obj,$media_id);
//        }
    }

    /**
     * 文本回复
     * @param $xml_obj
     * @param $msg
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
     * 图片回复
     * @param $xml_obj
     * @param $media_id
     */
     public function Image_response($xml_obj,$media_id){
         echo "<xml>
        <ToUserName><![CDATA[".$xml_obj->FromUserName."]]></ToUserName>
        <FromUserName><![CDATA[".$xml_obj->ToUserName."]]></FromUserName>
        <CreateTime>".time()."</CreateTime>
        <MsgType><![CDATA[image]]></MsgType>
        <Image><MediaId><![CDATA[".$media_id."]]></MediaId></Image>
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
