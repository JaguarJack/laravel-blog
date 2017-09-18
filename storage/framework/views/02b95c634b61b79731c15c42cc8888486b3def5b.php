<?php $__env->startSection('title','首页'); ?>
<?php $__env->startSection('keywords', '首页'); ?>
<?php $__env->startSection('description', '首页'); ?>
<?php $__env->startSection('class', 'detail'); ?>
<?php $__env->startSection('main'); ?>
<div class="blog_detail">
<div class="content" id="markdown">
	<div class="title">
	<span><?php echo e($article_info->title); ?></span>
	<div>
		<i class="fa fa-user-o"></i><?php echo e($article_info->author); ?> 发布与
		<i class="fa fa-clock-o"></i><?php echo e($article_info->created_at); ?>

		<i class="fa fa-tags"></i>
		<i class="fa fa-eye"></i>100
	</div>
	</div>
	<div class="article-content">
		<?php echo htmlspecialchars_decode($article_info->content); ?>

	</div>
</div>
	<div style="width:100%;height:50px;background-color:#fff;">
		<div style="width:50%;height:50px;margin:0 auto;text-align:center;">
		<?php if(!$liked): ?> 
			<span class="layui-btn layui-btn-radius layui-btn-primary like"><i class="fa fa-thumbs-o-up"></i>&nbsp; 点赞  <span><?php echo e($article_info->like_number); ?></span></span>		
		<?php else: ?>
		    <span class="layui-btn layui-btn-radius like"><i class="fa fa-thumbs-up"></i>&nbsp;点赞  <span><?php echo e($article_info->like_number); ?></span></span>
		<?php endif; ?>
		<?php if(!$stored): ?>
			<span class="layui-btn layui-btn-radius layui-btn-primary store">&nbsp;收藏  <span><?php echo e($article_info->store_number); ?></span></span>
		<?php else: ?>
			<span class="layui-btn layui-btn-radius store"><i class="layui-icon">&#xe6c6;</i>&nbsp;收藏  <span><?php echo e($article_info->store_number); ?></span></span>
		<?php endif; ?>
		</div>
	</div>
	<div style="width:100%;min-height:50px;background-color:#fff;">
	<?php if($preNext[1]): ?>
	<a href="<?php echo e(url('detail', ['id' => $preNext[1]->id])); ?>">
		<button class="layui-btn layui-btn-small layui-btn-danger"><i class="fa fa-arrow-left"></i>&nbsp;<?php echo e($preNext[1]->title); ?></button>
	</a>
	<?php endif; ?>
	<?php if($preNext[0]): ?>
	<a href="<?php echo e(url('detail', ['id' => $preNext[0]->id])); ?>">	
		<button class="layui-btn layui-btn-small layui-btn-danger" style="float:right;"><?php echo e($preNext[0]->title); ?>&nbsp;<i class="fa fa-arrow-right"></i></button>
	</a>
	<?php endif; ?>
	</div>
<div class="comment">
	<div class="reply">已回复评论(<?php echo e($comments->count()); ?>)</div>
	<div class="info">
	
	<?php if(!$comments->count()): ?>
		<div class="no-comment" style="display:none;">空空如也~快来成为第一个评论的人吧</div>
	<?php else: ?>	
	<ul>
		<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li>
				<div class="avatar">
					<img src="<?php echo e($comment->avatar); ?>"/>
				</div>
				<div class="comment-info">
					<div style="min-height:40px;">
					<div>
						<span  class="span-left" data="<?php echo e($comment->user_id); ?>"><a href="javascript:;"><?php echo e($comment->user_name); ?></a></span>
						<a href="javascript:;">
							<span class="span-right" data="<?php echo e($comment->user_id); ?>" name="<?php echo e($comment->user_name); ?>"><i class="fa fa-mail-reply"></i> 回复</span>
						</a>
						</div>
						<div class="time">
							<a href="<?php echo e(url('detail',['id' => $article_info->id ] )); ?>#reply<?php echo e($comment->id); ?>">#<?php echo e($key+1); ?></a> <?php echo e($comment->created_at); ?>

						</div>
					</div>
					<p><?php echo $comment->content; ?></p>
				</div>
			</li>
		 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	 <?php endif; ?>		
	</div>
	<div style="clear:both;"></div>
</div>
<div class="editor">
<textarea id="edit" name="comment" style="width:99%;border:1px solid #e6e6e6;border-radius:5px;min-height:100px;padding:5px 5px;"></textarea>
<button class="layui-btn submit_comment">提交评论</button>
</div>
<input type="hidden" name="reply_user" value="0">
</div>        		
<!--
<div class="tab">
  <div class="title"><?php echo e($article_info->uname); ?></div>
  <div class="layui-tab-content" style="min-height:100px;background-color:white;">
    <div class="layui-tab-item layui-show" style="min-height:200px;">
    
    	<div class="avatar">
    		<img src="<?php echo e($article_info->head_img); ?>">
    	</div>
    	<div class="sign">
    	个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介
    	</div>
    	<hr/>
    	<?php if($attented): ?>
    		<a href="javascript:;"><div class="btn attend" style="background-color: #009688;">已关注</div></a>
    	<?php else: ?>
    		<a href="javascript:;"><div class="btn attend">关注</div></a>
    	<?php endif; ?>
    </div>
  </div>
</div>  -->
<script src="<?php echo e(asset('/assets/markdown/js/jquery.min.js')); ?>"></script>
<link rel="stylesheet" href="<?php echo e(asset('/assets/markdown/css/editormd.preview.css')); ?>" />	
<script src="<?php echo e(asset('/assets/markdown/lib/marked.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/markdown/lib/prettify.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/markdown/lib/raphael.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/markdown/lib/underscore.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/markdown/lib/sequence-diagram.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/markdown/lib/flowchart.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/markdown/lib/jquery.flowchart.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/markdown/js/editormd.js')); ?>"></script>
<style>
    .editormd-html-preview {padding:0px;}    
</style>
<script>
var aid = "<?php echo e($article_info->id); ?>";
var attend_user_id = "<?php echo e($article_info->user_id); ?>";
layui.use(['jquery','layer'], function(){
	  var $ = layui.jquery
	  layer = layui.layer;

	  /* var eidt = layedit.build('edit', {
		  		height:190,
		 	    tool: ['face', 'strong','italic','underline','del','|' ,'left','center','right','link']
		}); */

		$('#edit').focus(function(){
			$(this).css('border','1px solid green')
		});
		$('#edit').blur(function(){
			$(this).css('border','1px solid #e6e6e6')
		});

		$('.span-right').click(function(){
			var user_id = $(this).attr('data');
			var name    = $(this).attr('name');
			var html    = '@'+name+' ';
			$('#edit').val(html);
			$('input[name=reply_user]').val(user_id);
			$('#edit').focus();
	    });

	    $('.submit_comment').click(function(){
			var reply_user = $('input[name=reply_user]').val();
			var aid        = "<?php echo e($article_info->id); ?>"
			var content    = $('#edit').val();

			$.post('/comment', {reply_user:reply_user, aid:aid, content:content},function(response){
					if (response.status == 10000) {
						window.location.reload();
					} else {
						layer.msg(response.msg);
				    }
			})

		})
		$('.span-left').mouseover(function(){
			layer.tips('只想提示地精准些', $(this), {
				tips: 1
			});
		});

	    $('.like').click(function(){
			$.post("<?php echo e(url('api/like')); ?>",{aid:aid,user_id:"<?php echo e($user_id); ?>"}, function(response){
					if (response.code == 10000) {
						window.location.reload();
					}
		    })
		})

		$('.store').click(function(){
			$.post("<?php echo e(url('api/store')); ?>",{aid:aid,user_id:"<?php echo e($user_id); ?>"}, function(response){
					if (response.code == 10000) {
						window.location.reload();
					}
		    })
		})
		
		$('.attend').click(function(){
			$.post("<?php echo e(url('api/attend')); ?>",{attend_user_id:attend_user_id,user_id:"<?php echo e($user_id); ?>"}, function(response){
					if (response.code == 10000) {
						window.location.reload();
					}
		    })
		})		
	});
//markdown解析
 $(function() {
     var testEditormdView, testEditormdView2;
		    testEditormdView = editormd.markdownToHTML("markdown", {
            // markdown        : markdown ,//+ "\r\n" + $("#append-test").text(),
             //htmlDecode      : true,       // 开启 HTML 标签解析，为了安全性，默认不开启
             htmlDecode      : "style,script,iframe",  // you can filter tags decode
             //toc             : false,
             tocm            : true,    // Using [TOCM]
             //tocContainer    : "#custom-toc-container", // 自定义 ToC 容器层
             //gfm             : false,
             //tocDropdown     : true,
             // markdownSourceCode : true, // 是否保留 Markdown 源码，即是否删除保存源码的 Textarea 标签
             emoji           : true,
             taskList        : true,
             tex             : true,  // 默认不解析
             flowChart       : true,  // 默认不解析
             sequenceDiagram : true,  // 默认不解析
         });
 });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>