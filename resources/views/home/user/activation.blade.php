@extends('layouts.userEdit')
@section('title','首页')
@section('keywords', '首页')
@section('description', '首页')
@section('content')
<div class="form">
	<div class="title">邮箱激活</div>
	@if ($activation == 1)
		<blockquote class="layui-elem-quote">目前使用的邮箱还未激活,请尽快激活</blockquote>
	@endif
	<form class="layui-form">
          <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block layui-disabled">
              <input type="text" name="title" value="{{ $email }}"  lay-verify="required|email" placeholder="请输入邮箱" autocomplete="off" readonly class="layui-input">
            </div>
          </div>
          
          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn sendMail" lay-submit lay-filter="active">点击激活</button>
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

  $('.sendMail').click(function(){
		$.get("{{ url('email/send') }}",function(response){
				layer.msg(response.msg);
	    })

		return false;
  })

});
</script>
@endsection