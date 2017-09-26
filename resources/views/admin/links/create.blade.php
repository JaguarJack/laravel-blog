@extends('layouts.admin')
@section('title', '添加友情链接')
@section('menu1', '友情链接管理')
@section('menu2', '添加友情链接')
@section('content')
<div class="form">
<form class="layui-form layui-form-pane">
  <div class="layui-form-item">
    <label class="layui-form-label">标题</label>
    <div class="layui-input-inline">
      <input type="text" name="title"  lay-verify="required" placeholder="请输入标题"  class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">链接</label>
    <div class="layui-input-inline">
      <input type="text" name="url" lay-verify="required|url" placeholder="请输入链接"  class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">状态</label>
    <div class="layui-input-block">
      <input type="radio" name="show" value="1" title="显示" checked>
      <input type="radio" name="show" value="2" title="不显示">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">类型</label>
    <div class="layui-input-block">
      <input type="radio" name="type" value="1" title="友情链接" checked>
      <input type="radio" name="type" value="2" title="技术站点">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">权重</label>
    <div class="layui-input-inline">
      <input type="text" name="weight" lay-verify="number" value='1'  class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn layui-btn-big layui-btn-normal" lay-submit lay-filter="add">添加</button>
    </div>
  </div>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
</div>
<script src="{{ asset('/assets/layui/layui.js') }}"></script>
<script>
layui.use('form', function(){
  var form = layui.form
  	  $    = layui.jquery;

  form.on('submit(add)', function(data){
	 $.post('/links', data.field, function(response){
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

