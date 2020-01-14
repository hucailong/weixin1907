@extends('layouts.admin')
@section('title', '渠道管理 - 展示')
@section('content')
    <h2>渠道管理 - 展示</h2>
    <div class="table-bordered table-responsive">
        <table class="table">
            <thead>

                <tr>
                    <th>编号</th>
                    <th>渠道名称</th>
                    <th>渠道标识</th>
                    <th>渠道二维码</th>

                    <th>关注人数</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td>{{$v['area_id']}}</td>
                    <td>{{$v['area_name']}}</td>
                    <td>{{$v['area_event_key']}}</td>
                    <td>
                        <img src="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={{$v['area_ticket']}}" alt=""width="100px">
                    </td>
                    <td>{{$v['attention_sum']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

