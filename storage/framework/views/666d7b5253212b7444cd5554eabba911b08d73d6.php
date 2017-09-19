<?php $__env->startSection('main'); ?>
    <div class="user-edit">
        <div class="user-edit-left">
        	<div class="user-edit-option">
        		<span class="layui-btn layui-btn-primary"><i class="fa fa-pencil-square-o"></i> 个人信息</span>
        		<span class="layui-btn layui-btn-primary"><i class="fa fa-github-alt"></i> 头像修改</span>
        		<span class="layui-btn layui-btn-primary"><i class="fa fa-key fa-fw"></i> 重置密码</span>
        		<span class="layui-btn layui-btn-primary"><i class="fa fa-envelope-o fa-fw"></i> 邮箱激活</span>
        		<span class="layui-btn layui-btn-primary"><i class="fa fa-snapchat"></i> 消息通知</span>
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