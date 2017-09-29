<?php $__env->startSection('keywords', config('home.site.keywords')); ?>
<?php $__env->startSection('description', config('home.site.description')); ?>
<?php $__env->startSection('main'); ?>
    <div class="user-edit">
        <div class="user-edit-left">
        	<div class="user-edit-option">
        		<a href="<?php echo e(url('user/edit')); ?>">
        			<span class="layui-btn layui-btn-primary"><i class="fa fa-pencil-square-o"></i> 个人信息</span>
        		</a>
        		<a href="<?php echo e(url('user/setAvatar')); ?>">
        			<span class="layui-btn layui-btn-primary"><i class="fa fa-github-alt"></i> 头像修改</span>
        		</a>
        		<a href="<?php echo e(url('user/setPassword')); ?>">
        			<span class="layui-btn layui-btn-primary"><i class="fa fa-key fa-fw"></i> 重置密码</span>
        		</a>
        		<a href="<?php echo e(url('user/activation')); ?>">
        			<span class="layui-btn layui-btn-primary"><i class="fa fa-envelope-o fa-fw"></i> 邮箱激活</span>
        		</a>
        		<a href="<?php echo e(url('user/notice')); ?>">
        			<span class="layui-btn layui-btn-primary"><i class="fa fa-snapchat"></i> 消息通知</span>
        		</a>
        	</div>
        </div>
        <div class="user-edit-right">
        	<?php echo $__env->yieldContent('content'); ?>
        </div>
        <div style="clear:both;"></div>
    </div>
</body>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>