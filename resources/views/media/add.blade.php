@extends('layouts.admin')

@section('title', '素材管理 - 添加')

@section('content')
    <h2>素材管理 - 添加</h2>
    <form method="post" action="{{url('admin/add_do')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label>素材名称</label>
            <input type="text" class="form-control" >
        </div>
        <div class="form-group">
            <label for="exampleInputFile">素材文件</label>
            <input type="file" name="">
        </div>
        <div class="form-group">
            <label>素材类型</label>
            <select name="" class="form-control" style="font-size: 12px ;  appearance:none;-webkit-appearance: none;-moz-appearance: none;">
                <option value="">-请选择-</option>
                <option value="">临时文件</option>
                <option value="">永久文件</option>
            </select>
        </div>
        <div class="form-group">
            <label>素材格式</label>
            <select name="" class="form-control" style="">
                <option value="#">-请选择-</option>
                <option value="">缩略图</option>
                <option value="">图片</option>
                <option value="">视频</option>
                <option value="">音频</option>
            </select>
        </div>

        <button type="submit">添加</button>
    </form>
@endsection