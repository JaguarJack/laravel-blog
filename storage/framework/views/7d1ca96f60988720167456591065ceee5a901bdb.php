<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>注册-NJPHPER BLOG</title>
    <link rel="stylesheet" href="<?php echo e(asset('/assets/layui/css/layui.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/assets/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/assets/css/public.css')); ?>">
</head>
<body class="body">
    <div class="main">
    	<div class="register">
    		<div class="title">注&nbsp;&nbsp;册</div>
    		<form action="/doRegister" method="post" class="layui-form">
    		  <div class="layui-form-item">
                <div class="layui-input-block">
                  <input type="text" id="name" name="name" placeholder="请输入你的昵称" autocomplete="off" value="<?php echo e(old('name')); ?>" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <input type="text" id="email" name="email" placeholder="请输入邮箱" autocomplete="off" value="<?php echo e(old('email')); ?>" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <input type="password" id="password" name="password"  placeholder="请输入密码" autocomplete="off" class="layui-input">
                </div>
            </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn register-btn" lay-submit lay-filter="register">注&nbsp;&nbsp;册</button>
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
               <a href="<?php echo e(url('signin')); ?>">
              		<span class="layui-btn  layui-btn-primary">已有账号前去登录</span>
               </a>
            </div>
          </div>
          <?php echo e(csrf_field()); ?>

        </form>
        </div>
    </div>
</body>
<script src="<?php echo e(asset('/assets/layui/layui.js')); ?>"></script>
<script>
//Demo
layui.use(['form', 'jquery'], function(){
  var form = layui.form
  		$  = layui.jquery;
  
  //监听提交
  form.on('submit(register)', function(data){
	  $('.register-btn').addClass('layui-btn-disabled').html('正在提交注册...')
  });
  <?php if($errors->has('name')): ?>
	  layer.tips("<?php echo e($errors->first('name')); ?>", '#name');
  	  return false;
  <?php endif; ?>
  <?php if($errors->has('email')): ?>
	  layer.tips("<?php echo e($errors->first('email')); ?>", '#email');
  	  return false;
  <?php endif; ?>
  <?php if($errors->has('password')): ?>
	  layer.tips("<?php echo e($errors->first('password')); ?>", '#password');
      return false;
  <?php endif; ?>
});
</script>