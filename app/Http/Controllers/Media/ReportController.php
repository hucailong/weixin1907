<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Wechat\Report;
use Illuminate\Support\Facades\Cache;
class ReportController extends Controller
{
     public function add() {
            return view('report.add');
     }

     public function add_do(Request $request){
         $data = $request->all();
//         $report_sum = Cache::increment('report_sum');
         Report::create([
             'report_title'  => $data['report_title'],
             'report_content'=> $data['report_content'],
             'report_author' => $data['report_author'],
             'report_time'   => time(),
         ]);
     }

     public function show(){

         return view('report.show',['data'=>Report::all()->toArray()]);
     }

     public function del(){

     }
}
