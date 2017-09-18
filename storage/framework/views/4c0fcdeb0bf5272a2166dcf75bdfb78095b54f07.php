<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>NJPHPER BLOG ADMIN</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="JaguarJack">
        <link rel="stylesheet" href="<?php echo e(asset('/assets/layui/css/layui.css')); ?>" media="all">
    </head>
    <body style="background-image: url('<?php echo e(asset('/assets/images/login_bg.jpg')); ?>');">
	<div style="height:500px;width:400px;margin:0px auto;padding-right:180px;padding-top:200px;opacity: 0.8;">
        <form class="layui-form" action="/login" method="post" style="margin:0px auto;">
          <div class="layui-form-item">
          <?php echo e(csrf_field()); ?>

            <div class="layui-input-block">
              <input type="text" name="email" id="email" required  lay-verify="required|email" placeholder="请输入邮箱" autocomplete="off" value="<?php echo e(old('email')); ?>" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <input type="password" name="password" id="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
            </div>
          </div>
           <div class="layui-form-item" pane="">
                <div class="layui-input-block">
                  <input type="checkbox" name="remember" lay-skin="primary" title="记住我" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                </div>
            </div>
            <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn layui-btn-big layui-btn-radius layui-btn-norma" lay-submit lay-filter="login">登录 </button>
            </div>
          </div>
        </form>
	</div>
    </body>

</html>
 <script src="<?php echo e(asset('/assets/layui/layui.js')); ?>"></script>
<script>
//Demo
layui.use('form', function(){
  var form = layui.form
  	  $    = layui.jquery;
  //监听提交
  form.on('submit(login)', function(data){});
  <?php if($errors->has('email')): ?>
	  layer.tips("<?php echo e($errors->first('email')); ?>", '#email');
  <?php endif; ?>
  <?php if($errors->has('password')): ?>
	  layer.tips("<?php echo e($errors->first('password')); ?>", '#password');
  <?php endif; ?>
});
</script>