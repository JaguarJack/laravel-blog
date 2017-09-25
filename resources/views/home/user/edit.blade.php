@extends('layouts.userEdit')
@section('title','个人信息编辑')
@section('content')
<div class="form">
	<div class="title">个人信息编辑</div>
	<form class="layui-form">
          <div class="layui-form-item">
            <label class="layui-form-label">昵称</label>
            <div class="layui-input-block">
              <input type="text" name="user_name" required  lay-verify="required" value="{{ $user->user_name }}" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
              <input type="email" name="email" required lay-verify="required|email" value="{{ $user->email }}" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">真实姓名</label>
            <div class="layui-input-block">
              <input type="text" name="real_name" placeholder="请输入真实姓名" value="{{ $user->real_name }}" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">性别</label>
            <div class="layui-input-block">
              <select name="gender">
                <option value="0">请选择</option>
                <option value="1" @if($user->gender == 1) selected @endif>男</option>
                <option value="2" @if($user->gender == 2) selected @endif>女</option>
              </select>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">Github Name</label>
            <div class="layui-input-block">
              <input type="text" name="github_name"  value = "{{ $user->github_name }}"placeholder="请输入Github Name" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">Github 主页</label>
            <div class="layui-input-block">
              <input type="text" name="github_homepage" value = "{{ $user->github_homepage }}" placeholder="请输入Github 主页" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">公司</label>
            <div class="layui-input-block">
              <input type="text" name="company" value = "{{ $user->company }}" placeholder="请输入公司名称" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">城市</label>
            <div class="layui-input-block">
              <input type="text" name="city" value = "{{ $user->city }}" placeholder="请输入所在城市" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">微博名</label>
            <div class="layui-input-block">
              <input type="text" name="sina_name" value = "{{ $user->sina_name }}" placeholder="请输入微博名" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">微博主页</label>
            <div class="layui-input-block">
              <input type="text" name="sina_homepage" value = "{{ $user->sina_homepage }}" placeholder="请输入微博主页" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">个人网址</label>
            <div class="layui-input-block">
              <input type="text" name="website"  value = "{{ $user->website }}" placeholder="请输入个人网址" autocomplete="off" class="layui-input">
            </div>
          </div>
           <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">个人简介</label>
                <div class="layui-input-block">
                  <textarea name="introduction" placeholder="请输入个人简介" class="layui-textarea">{{ $user->introduction }}</textarea>
                </div>
           </div>
           
           <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">个人署名</label>
                <div class="layui-input-block">
                  <textarea name="signature" placeholder="请输入个人署名，个人署名会追加在你的发表的文章后面" class="layui-textarea">{{ $user->signature }}</textarea>
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

  		form.on('submit(edit)', function(data){
  	  		$('.layui-btn').remove();
	    	$.post("{{ url('user/updateUserInfo')}}",data.field,function(response){
					layer.msg(response.msg, {
						  time: 2000 
						}, function(){
						  window.location.reload();
					})
			})
	    return false;
	  });

});
</script>
@endsection