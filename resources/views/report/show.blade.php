@extends('layouts.admin')
@section('title', '新闻管理 - 展示')
@section('content')
    <h2>新闻管理 - 展示</h2>
    <div class="table-bordered table-responsive">
        <table class="table">
            <thead>

                <tr>
                    <th>标题</th>
                    <th>内容</th>
                    <th>作者</th>
                    <th>时间</th>
                    {{--<th>Wechat-media_id</th>--}}
                    <th>访问量</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <input type="hidden" value="{{$v['report_id']}}">
                    <td>{{$v['report_title']}}</td>
                    <td>{{$v['report_content']}}</td>
                    <td>{{$v['report_author']}}</td>
                    <td>{{date('Y-m-d H:i:s',$v['report_time'])}}</td>
                    <td>{{$v['report_sum']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

