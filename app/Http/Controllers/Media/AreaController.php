<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Tools\Curl;
use App\Tools\Wechat;
use App\Wechat\Report;
use Illuminate\Http\Request;
use App\Wechat\Area;
class AreaController extends Controller
{
        public function add(){
            return view('area.add');
        }


        public function add_do (Request $request){
            $data = $request->input();

            $Access_token = Wechat::getAccessToken();

            $url ="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$Access_token."";

            $PostData = '{"expire_seconds": 2592000, "action_name": "QR_STR_SCENE", "action_info": {"scene": {"scene_str": "'.$data['area_event_key'].'"}}}';
            $ticket = json_decode(Curl::Post($url,$PostData),true)['ticket'];
            $Info = Area::create([
                'area_name'=>$data['area_name'],
                'area_event_key'=>$data['area_event_key'],
                'area_ticket' =>$ticket
            ]);
        }


        public function show(){
            $data = Area::all();

            return view('area.show',['data'=>$data]);
        }


}
