<?php $__env->startSection('title','分享'); ?>
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
    			<span class="info"><a href="javascript:;"><?php echo e($article->category); ?></a> · 点赞   <?php echo e($article->like_number); ?> · 收藏 <?php echo e($article->store_number); ?> · 评论  <?php echo e($article->comment_number); ?> · 发表于 <?php echo e($article->created_at); ?></span>
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
    	    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    			<li>
        			<span style="font-size:13px;opacity:0.6;">在</span>&nbsp;
        			<a href="<?php echo e(url('detail',['id' => $comment->aid])); ?>.html#reply<?php echo e($comment->aid); ?>"><?php echo e($comment->title); ?></a>&nbsp;
        			<span class="info">at <?php echo e($comment->created_at); ?> · 评论</span>
    				<div class="reply-info"><?php echo $comment->content; ?></div>
        		</li>
    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    	</ul>
	<div class="no-reply" style="display:none;">空空如也~</div>
		
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>