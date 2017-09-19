<!--
  
  
   
 -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $__env->yieldContent('title'); ?>-凝聚博客</title>
    <meta name="keywords" content= <?php echo $__env->yieldContent("keywords"); ?> />
    <meta name="description" content= <?php echo $__env->yieldContent("description"); ?> />
    <link rel="stylesheet" href="<?php echo e(asset('/assets/layui/css/layui.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/assets/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/assets/css/public.css')); ?>">
    <script src="<?php echo e(asset('/assets/layui/layui.js')); ?>"></script>
    <script>
    //注意：导航 依赖 element 模块，否则无法进行功能性操作
    layui.use(['element', 'util'], function(){
      var element = layui.element
      	  util    = layui.util;
      util.fixbar({});
    });
    </script>   
</head>
<body class="body">
    <ul class="layui-nav" lay-filter="filter-nav">
    <div class="nav">
     <div class="nav-right">
     <li class="layui-nav-item"><a href="/">首页</a>
      <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      	<li class="layui-nav-item"><a href="javascript:;"><?php echo e($menu['name']); ?></a>
      	
      	<?php if(count($menu[$menu['id']])): ?>
          	<dl class="layui-nav-child"> <!-- 二级菜单 -->
          	<?php $__currentLoopData = $menu[$menu['id']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <dd><a href="<?php echo e(url('/s/')); ?>"><?php echo e($_menu['name']); ?></a></dd>
    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
        </dl>
        </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <span>
      <?php if(Auth::guard('home')->check()): ?>
           <li class="layui-nav-item">
           <?php $notice = app('App\Service\NoticeService'); ?>
            <a href="<?php echo e(url('user',['id' => Auth::guard('home')->user()->id ])); ?>">个人中心<span class="layui-badge"><?php echo e($notice->getNotRead(Auth::guard('home')->user()->id)); ?></span></a>
          </li>
          <li class="layui-nav-item">
            <a href=""><img src="http://t.cn/RCzsdCq" class="layui-nav-img"><?php echo e(Auth::guard('home')->user()->user_name); ?></a>
            <dl class="layui-nav-child">
              <dd><a href="javascript:;"><i class="fa fa-cog"></i> 编辑信息</a></dd>
              <dd><a href="javascript:;"><i class="fa fa-power-off"></i> 安全管理</a></dd>
              <dd><a href="<?php echo e(url('signout')); ?>"><i class="fa fa-power-off"></i> 退出</a></dd>
            </dl>
          </li>
         <?php else: ?>
           <li class="layui-nav-item">
           <a href="<?php echo e(url('signup')); ?>">注册</a>
          </li>
          <li class="layui-nav-item">
            <a href="<?php echo e(url('signin')); ?>">登录</a>
          </li>
          <?php endif; ?> 
      </span>
      </div>
    </ul>
    <?php echo $__env->yieldContent('main'); ?>
    <div class="footer">
    </div>
</body>
</html>