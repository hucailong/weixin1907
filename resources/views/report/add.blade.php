@extends('layouts.admin')

@section('title', '新闻管理 - 添加')

@section('content')
    <h2>新闻管理 - 添加</h2>
    <form method="post" action="{{url('admin/report_add_do')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label>标题</label>
            <input type="text" class="form-control" name="report_title">
        </div>
        <div class="form-group">
            <label class="name">内容</label>
            <textarea class="form-control" rows="3" name="report_content"></textarea>
        </div>
        <div class="form-group">
            <label>作者</label>
            <input type="text" class="form-control" name="report_author">
        </div>
        <button type="submit" class="btn btn-default">添加</button>
    </form>
@endsection