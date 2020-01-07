@extends('layouts.admin')

@section('title', '新闻管理 - 添加')

@section('content')
    <h2>渠道管理 - 添加</h2>
    <form method="post" action="{{url('admin/area_add_do')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label>渠道名称</label>
            <input type="text" class="form-control" name="area_name">
        </div>
        <div class="form-group">
            <label>渠道标识</label>
            <input type="text" class="form-control" name="area_event_key">
        </div>
        <button type="submit" class="btn btn-default">添加</button>
    </form>
@endsection