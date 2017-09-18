<?php $__env->startSection('main'); ?>
    <div class="user">
        <div class="user-left">
        	<div class="user-card">
        		<div class="name">author</div>
        		<div class="avatar">
        			<img src="https://dn-phphub.qbox.me/uploads/avatars/18206_1502242007.png?imageView2/1/w/200/h/200">
        		</div>
        		<hr/>
        		<div class="intro">
        			<div><span class="layui-badge-dot layui-bg-gray"></span> 第 18206 位会员</div>
        			<div><span class="layui-badge-dot layui-bg-gray"></span> 注册at 2017-09-25</div>
         			<div><span class="layui-badge-dot layui-bg-gray"></span> 最近登录 2017-89-63</div>
        		</div>
        		<span class="layui-btn layui-btn-primary"><i class="fa fa-pencil-square-o"></i> 编 辑 资 料</span>
        	</div>
        	<div class="user-relate">
        		<span class="layui-btn layui-btn-primary"><i class="fa fa-pencil"></i> Ta 发布的文章</span>
        		<span class="layui-btn layui-btn-primary"><i class="fa fa-comments-o"></i> Ta 发表的评论</span>
        		<span class="layui-btn layui-btn-primary"><i class="fa fa-eye"></i> Ta 关注的用户</span>
        		<span class="layui-btn layui-btn-primary"><i class="fa fa-thumbs-up"></i> Ta 赞过的文章</span>
        		<span class="layui-btn layui-btn-primary"><i class="fa fa-plus-square-o"></i> Ta 收藏的文章</span>
        		
        	</div>
        </div>
        <div class="user-right">
        	<?php echo $__env->yieldContent('content'); ?>
        </div>
        <div style="clear:both;"></div>
    </div>
<script src="<?php echo e(asset('/assets/layui/layui.js')); ?>"></script>
<script>
//注意：导航 依赖 element 模块，否则无法进行功能性操作
layui.use(['element','jquery'], function(){
  var element = layui.element
  			$ = layui.jquery
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>