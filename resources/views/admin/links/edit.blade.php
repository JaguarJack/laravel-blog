@extends('layouts.admin')
@section('title', '添加用户')
@section('menu1', '用户管理')
@section('menu2', '编辑用户')
@section('content')
<div class="form">
<form class="layui-form layui-form-pane">
  <div class="layui-form-item">
    <label class="layui-form-label">标题</label>
    <div class="layui-input-inline">
      <input type="text" name="title"  lay-verify="required" value="{{ $link_info->title }}"  class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">链接</label>
    <div class="layui-input-inline">
      <input type="text" name="url" lay-verify="required|url" value="{{ $link_info->url }}" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">状态</label>
    <div class="layui-input-block">
      <input type="radio" name="show" value="1" title="显示" @if ($link_info->show == 1) checked @endif>
      <input type="radio" name="show" value="2" title="不显示"@if ($link_info->show == 2) checked @endif>
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">权重</label>
    <div class="layui-input-inline">
      <input type="text" name="weight" lay-verify="number" value="{{ $link_info->weight }}"  class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn layui-btn-big layui-btn-normal" lay-submit lay-filter="add">添加</button>
    </div>
  </div>
  {{ method_field('PUT') }}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="id" value="{{ $link_info->id }}">
</form>
</div>
<script src="{{ asset('/assets/layui/layui.js') }}"></script>
<script>
layui.use('form', function(){
  var form = layui.form
  	  $    = layui.jquery;

  var url = "{{ url('links',['id' => $link_info->id]) }}";
  form.on('submit(add)', function(data){
	 $.post(url, data.field, function(response){
		 if (response.status == 1000) {
			 layer.msg(response.msg, function(){
				 alert(123)
				 window.location.href = "{{ url('user') }}";
			 });
			 
		 } else {
			 layer.msg(response.msg);
		 }
	 });

	 return false;
  });

})
</script>
@endsection

