@extends('layouts.userEdit')
@section('title','首页')
@section('keywords', '首页')
@section('description', '首页')
@section('content')
<div class="form">
	<div class="title">个人信息编辑</div>
	<form class="layui-form" action="">
          <div class="layui-form-item">
            <label class="layui-form-label">昵称</label>
            <div class="layui-input-block">
              <input type="text" name="title" required  lay-verify="required" placeholder="请输入昵称" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
              <input type="email" name="email" required lay-verify="required" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">真实姓名</label>
            <div class="layui-input-block">
              <input type="text" name="real_name" lay-verify="required" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">性别</label>
            <div class="layui-input-block">
              <select name="gender">
                <option value="0">请选择</option>
                <option value="1">男</option>
                <option value="2">女</option>
              </select>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">Github Name</label>
            <div class="layui-input-block">
              <input type="text" name="github_name" lay-verify="required" placeholder="请输入Github Name" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">Github 主页</label>
            <div class="layui-input-block">
              <input type="text" name="github_homepage" lay-verify="required" placeholder="请输入Github 主页" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">公司</label>
            <div class="layui-input-block">
              <input type="text" name="company" lay-verify="required" placeholder="请输入公司名称" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">城市</label>
            <div class="layui-input-block">
              <input type="text" name="city" lay-verify="required" placeholder="请输入所在城市" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">微博名</label>
            <div class="layui-input-block">
              <input type="text" name="sina_name" lay-verify="required" placeholder="请输入微博名" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">微博主页</label>
            <div class="layui-input-block">
              <input type="text" name="sina_homepage" lay-verify="required" placeholder="请输入微博主页" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">个人网址</label>
            <div class="layui-input-block">
              <input type="text" name="website" lay-verify="required" placeholder="请输入个人网址" autocomplete="off" class="layui-input">
            </div>
          </div>
           <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">个人简介</label>
                <div class="layui-input-block">
                  <textarea name="introduction" placeholder="请输入个人简介" class="layui-textarea"></textarea>
                </div>
           </div>
           
           <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">个人署名</label>
                <div class="layui-input-block">
                  <textarea name="signature" placeholder="请输入个人署名，个人署名会追加在你的发表的文章后面" class="layui-textarea"></textarea>
                </div>
           </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit lay-filter="edit">立即修改</button>
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