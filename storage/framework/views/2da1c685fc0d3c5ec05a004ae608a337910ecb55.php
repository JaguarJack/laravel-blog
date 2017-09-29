<?php $__env->startSection('keywords', config('home.site.keywords')); ?>
<?php $__env->startSection('description', config('home.site.description')); ?>
<?php $__env->startSection('main'); ?>
<script src="<?php echo e(asset('/assets/layui/layui.js')); ?>"></script>
    <div class="user">
        <div class="user-left">
        	<div class="user-card">
        		<div class="name"><?php echo e($user->user_name); ?></div>
        		<div class="avatar">
        			<img src="<?php echo e($user->avatar); ?>">
        		</div>
        		<hr/>
        		<div class="intro">
        			<div><span class="layui-badge-dot layui-bg-gray"></span> 第 <?php echo e($user->id); ?> 位会员</div>
        			<div><span class="layui-badge-dot layui-bg-gray"></span> 注册at  <?php echo e($user->created_at); ?></div>
         			<div><span class="layui-badge-dot layui-bg-gray"></span> <?php echo e($user->introduction ? : '一位不愿介绍的博友~'); ?></div>
        		</div>
        		<div style="text-align:center;padding-top:10px;padding-bottom:10px;">
    			<?php if($user->github_homepage): ?>
        			<a href="<?php echo e($user->github_homepage); ?>" target="_blank">
        				<span class="layui-btn layui-btn-radius layui-btn-mini layui-btn-primary" data="<?php echo e($user->github_name ? : $user->github_homepage); ?>" ><i class="fa fa-github" aria-hidden="true"></i> github</span>
        			</a>
    			<?php endif; ?>
    			<?php if($user->sina_homepage): ?>
        			<a href="<?php echo e($user->sina_homepage); ?>" target="_blank">
        				<span class="layui-btn layui-btn-radius layui-btn-mini layui-btn-primary" data="<?php echo e($user->sina_name ? : $user->sina_homepage); ?>" ><i class="fa fa-weibo" aria-hidden="true"></i> 微博</span>
        			</a>
    			<?php endif; ?>
    			<?php if($user->website): ?>
        			<a href="<?php echo e($user->website); ?>" target="_blank">
        				<span class="layui-btn layui-btn-radius layui-btn-mini layui-btn-primary" data="<?php echo e($user->website); ?>" ><i class="fa fa-globe" aria-hidden="true"></i> 个人网站</span>
        			</a>
    			<?php endif; ?>
    			<?php if($user->city): ?>
        			<a href="javascript:;">
        				<span class="layui-btn layui-btn-radius layui-btn-mini layui-btn-primary" data="<?php echo e($user->city); ?>" ><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo e($user->city); ?></span>
        			</a>
    			<?php endif; ?>
    			</div>
    			<?php if(Auth::guard('home')->user() && Auth::guard('home')->user()->id == $id): ?>
            		<a href="<?php echo e(url('/user/edit')); ?>">
            			<span class="layui-btn layui-btn-primary edit_btn"><i class="fa fa-pencil-square-o"></i> 编 辑 资 料</span>
            		</a>
        		<?php endif; ?>
        	</div>
        	<div class="user-relate">
        	    <a href="<?php echo e(route('user.share',[ $id ])); ?>">
        			<span class="layui-btn layui-btn-primary"><i class="fa fa-pencil"></i> Ta 发布的文章</span>
        		</a>
        		<a href="<?php echo e(route('user.comment',[ $id ])); ?>">
        			<span class="layui-btn layui-btn-primary"><i class="fa fa-comments-o"></i> Ta 发表的评论</span>
        		</a>
        		<a href="<?php echo e(route('user.attend',[ $id ])); ?>">
        			<span class="layui-btn layui-btn-primary"><i class="fa fa-eye"></i> Ta 关注的用户</span>
        		</a>
        		<a href="<?php echo e(route('user.like',[ $id ])); ?>">
        			<span class="layui-btn layui-btn-primary"><i class="fa fa-thumbs-up"></i> Ta 赞过的文章</span>
        		</a>
        		<a href="<?php echo e(route('user.stores',[ $id ])); ?>">
        			<span class="layui-btn layui-btn-primary"><i class="fa fa-plus-square-o"></i> Ta 收藏的文章</span>
        		</a>
        	</div>
        </div>
        <div class="user-right">
        	<?php echo $__env->yieldContent('content'); ?>
        </div>
        <div style="clear:both;"></div>
    </div>

<script>
//注意：导航 依赖 element 模块，否则无法进行功能性操作
layui.use(['element','jquery','layer'], function(){
  var element = layui.element
  		layer = layui.layer
  		    $ = layui.jquery;

  $('.layui-btn-mini').hover(function(){
		layer.tips($(this).attr('data'),$(this),{tips:1});
  })
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>