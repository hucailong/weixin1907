@extends('layouts.admin')
@section('title', '素材管理 - 展示')
@section('content')
    <h2>响应式表格布局</h2>
    <div class="table-bordered table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>素材编号</th>
                    <th>素材名称</th>
                    <th>素材展示</th>
                    <th>媒体格式</th>
                    {{--<th>Wechat-media_id</th>--}}
                    <th>添加时间</th>
                    <th>过期时间</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td>{{$v['media_id']}}</td>
                    <td>{{$v['media_name']}}</td>
                    <td>
                        @if($v['media_format'] == "image")
                            <img src="/{{$v['media_path']}}" width="100px">
                        @elseif($v['media_format'] == "voice")
                            <audio src="/{{$v['media_path']}}" controls="controls" width="100px"></audio>
                        @elseif($v['media_format'] == "video")
                            <video src="/{{$v['media_path']}}" controls="controls" width="200px"></video>
                        @endif
                    </td>
                    <td>
                        @if($v['media_type']==1)
                            临时素材
                        @else
                            永久素材
                        @endif
                    </td>
                    {{--<td>{{$v['wechat_media_id']}}</td>--}}
                    <td>{{date('Y-m-d H:i:s',$v['add_time'])}}</td>
                    <td>{{date('Y-m-d H:i:s',$v['over_time'])}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

