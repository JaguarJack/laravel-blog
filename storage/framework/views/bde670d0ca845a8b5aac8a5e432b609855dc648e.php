<?php $__env->startSection('title','首页'); ?>
<?php $__env->startSection('keywords', '首页'); ?>
<?php $__env->startSection('description', '首页'); ?>
<?php $__env->startSection('content'); ?>
<div class="share">
	<div class="title">分享发布</div>
	<a href="<?php echo e(url('write')); ?>">
	<div class="btn"><i class="fa fa-pencil"></i> 分享所思所闻</div>
	</a>
</div>
<div class="write">
	<div class="title">最新发布</div>
	<div>
		<ul>
		<?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
			<li>
    			<span class="layui-badge-dot layui-bg-orange"></span>&nbsp;&nbsp;
    			<a href="<?php echo e(url('detail',['id' => $article->id])); ?>"> <?php echo e($article->title); ?></a>&nbsp;&nbsp;
    			<span class="info"><a href="javascript:;"><?php echo e($article->category); ?></a> · 点赞   0 · 收藏  0 · 评论  0 · 发表于 2017-09-26</span>
    		</li>
    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    	</ul>
		<div class="no-article" style="display:none;">空空如也~</div>
	</div>
</div>
<div class="reply">
	<div class="title">最新评论</div>
	<div>
	<ul>
			<li>
    			<span style="font-size:13px;opacity:0.6;">在</span>&nbsp;
    			<a href="javascript:;">这是第一篇文章</a>&nbsp;
    			<span class="info">@2017-09-23 · 评论</span>
				<div class="reply-info">123123123123123</div>
    		</li>
    	</ul>
		<div class="no-reply" style="display:none;">空空如也~</div>
		
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>