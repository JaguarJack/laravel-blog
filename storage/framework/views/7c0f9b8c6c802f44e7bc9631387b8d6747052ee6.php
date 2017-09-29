<?php $__env->startSection('title','消息通知'); ?>
<?php $__env->startSection('content'); ?>
<div class="form">
	<div class="title">消息通知</div>
	<?php if($notice->count()): ?>
    	<ul class="layui-timeline">
    	<?php $__currentLoopData = $notice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li class="layui-timeline-item" >
            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
            <div class="layui-timeline-content layui-text" <?php if($vo->is_read == 2): ?> style="opacity:0.5;"<?php endif; ?>>
              <h3 class="layui-timeline-title"><?php echo e($vo->from_user_name); ?> </h3>
              <p>
              	 <?php if($vo->type == 1): ?>
               	  	 在文章 <a href="javascript:;"><?php echo e($vo->title); ?></a> 评论了
               	 <?php else: ?>
               	   	发布新文章  <a href="javascript:;"><?php echo e($vo->title); ?></a>
               	 <?php endif; ?>
                <?php if($vo->is_read == 1): ?>
                <a href="<?php echo e(url('detail',['id' => $vo->aid])); ?>.html#reply<?php echo e($vo->comment_id); ?>">
                    <span onclick='read("<?php echo e($vo->id); ?>")'>
                    	点击查看
                    </span>
                </a>
                <?php else: ?>
                 <span class="delete" data="<?php echo e($vo->id); ?>">
                	已查看/删除
                 </span>
                <?php endif; ?>
              </p>
            </div>
          </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <li class="layui-timeline-item">
        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
        <div class="layui-timeline-content layui-text">
          <div class="layui-timeline-title">
          	只有这么多了~
          </div>
        </div>
      </li> 
    </ul>
  <?php else: ?>
  		<div style="text-align: center;margin-top: 100px;opacity: 0.5;font-size: 16px;">没有消息通知~空空如也~</div>
  <?php endif; ?>
</div>
<script src="<?php echo e(asset('/assets/layui/layui.js')); ?>"></script>
<script>
layui.use(['element','jquery'], function(){
  var element = layui.element
  			$ = layui.jquery;

   $('.delete').click(function(){
		var id = $(this).attr('data');
		$.post('/deleteNotice', {id,id}, function(response) {
			if (response.status == 10000) {
				$('.delete').parents('.layui-timeline-item').remove()
			}
		})
	})

});

function read(id) {
	$.post('/readNotice',{id,id},function(){})
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.userEdit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>