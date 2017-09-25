<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>登录-凝聚博客</title>
    <link rel="stylesheet" href="{{ asset('/assets/layui/css/layui.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/public.css') }}">
</head>
<body class="body">
    <div class="main">
    	<div class="login">
    		<div class="title">登&nbsp;&nbsp;录</div>
    		<form class="layui-form" action="/doLogin" method="post">
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <input type="text" name="email" id="email" lay-verify="required|email" placeholder="请输入邮箱" autocomplete="off" value="{{ old('email') }}" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <input type="password" name="password" id="password" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" pane="">
                <div class="layui-input-block">
                  <input type="checkbox" name="remember" lay-skin="primary" title="记住我" {{ old('remember') ? 'checked' : '' }}>
                </div>
            </div>
            {{ csrf_field() }}
          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit lay-filter="login">登&nbsp;&nbsp;录</button>
            </div>
          </div>
          <div class="reset">还可以选择一下方式登录or注册~<a href="">忘记密码?</a></div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <span class="layui-btn  layui-btn-primary">Github登录</span>
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <span class="layui-btn  layui-btn-primary">QQ登录</span>
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <span class="layui-btn  layui-btn-primary">微博登录</span>
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <a href="{{ url('signup') }}">
              	<span class="layui-btn  layui-btn-primary">注册</span>
              </a>
            </div>
          </div>
        </form>
        </div>
    </div>
</body>
<script src="{{ asset('/assets/layui/layui.js') }}"></script>
<script>
//Demo
layui.use(['form', 'jquery'], function(){
  var form = layui.form
  		$  = layui.jquery;
  
  //监听提交
  form.on('submit(login)',function(data){});
  @if ($errors->has('email'))
	  layer.tips("{{ $errors->first('email') }}", '#email');
  	  return false;
  @endif
  @if ($errors->has('password'))
	  layer.tips("{{ $errors->first('password') }}", '#password');
      return false;
  @endif
});
</script>