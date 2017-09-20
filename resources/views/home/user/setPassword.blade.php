@extends('layouts.userEdit')
@section('title','首页')
@section('keywords', '首页')
@section('description', '首页')
@section('content')
<div class="form">
	<div class="title">密码修改</div>
	<form class="layui-form" action="">
          <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block layui-disabled">
              <input type="text" name="title" value="{{ $email }}" lay-verify="required" placeholder="请输入邮箱" autocomplete="off" readonly class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
              <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">确认密码</label>
            <div class="layui-input-block">
              <input type="password" name="comfirm_password" lay-verify="required" placeholder="请确认密码" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit lay-filter="edit">确认修改</button>
            </div>
          </div>
       </form>
</div>
<script src="{{ asset('/assets/layui/layui.js') }}"></script>
<script>
layui.use(['element','jquery','form'], function(){
  var element = layui.element
  			$ = layui.jquery
  		form  = layui.form;

});
</script>
@endsection