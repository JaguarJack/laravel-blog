<?php $__env->startSection('title','Ta 喜欢的'); ?>
<?php $__env->startSection('content'); ?>
<div class="user-nav">
	<a href="<?php echo e(url('user/center')); ?>"> 个人中心 </a>  <span style="opacity:0.5;">\ 个人喜欢</span>
</div>
<div class="write">
	<div class="title">个人喜欢(<?php echo e($total); ?>)</div>
		<?php if($total): ?>
            <ul class="layui-timeline" id="user-like"></ul>
    		<div id="page"></div>
		<?php else: ?>
			<div class="no-article">空 空 如 也  ~</div>
		<?php endif; ?> 
</div>
<script>
   layui.use(['laypage','jquery'], function(){
      var laypage = layui.laypage
      		$     = layui.jquery;
      laypage.render({
        elem: "page"
        ,count: "<?php echo e($total); ?>"
        ,jump: function(obj, first){
            $.get('/getLikeArticles', {page:obj.curr,user_id:"<?php echo e($id); ?>"} ,function(data){
				var str = '';
				var data = data.data;
				for (i=0;i < data.length;i++) {
					str += '<li>';
					str += '<span><span class="layui-badge-dot layui-bg-orange"></span>&nbsp;&nbsp;'
    			    str += '<a href="/detail/'+data[i].aid+'.html">'+data[i].title+'</a>&nbsp;&nbsp;--&nbsp;&nbsp;'
    				str += '<span class="info">·<a href="/category/'+data[i].cid+'"> '+data[i].category+' · <a href="/user/'+data[i].aid+'">'+data[i].author+'</a></span>'
    				str += '</li>';
				}
				$('#user-like').html(str);
            })
      	}
    });
   })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>