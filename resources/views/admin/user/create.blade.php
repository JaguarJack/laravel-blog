@extends('layouts.admin')
@section('title', '添加用户')
@section('menu1', '用户管理')
@section('menu2', '添加用户')
@section('content')
<div class="form">
<form class="layui-form layui-form-pane">
  <div class="layui-form-item">
    <label class="layui-form-label">用户名</label>
    <div class="layui-input-inline">
      <input type="text" name="name"  lay-verify="required" placeholder="请输入用户名"  class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">邮箱</label>
    <div class="layui-input-inline">
      <input type="text" name="email" lay-verify="required|email" placeholder="请输入邮箱"  class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">密码</label>
    <div class="layui-input-inline">
      <input type="text" name="password" lay-verify="required"  placeholder="请输入密码"  class="layui-input">
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
	 $.post('/user', data.field, function(response){
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

