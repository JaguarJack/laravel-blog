<?php $__env->startSection('title', config('home.site.title')); ?>
<?php $__env->startSection('keywords', config('home.site.keywords')); ?>
<?php $__env->startSection('description', config('home.site.description')); ?>
<?php $__env->startSection('class', 'main'); ?>
<?php $__env->startSection('carousel'); ?>
<div class="layui-carousel" id="carousel">
      <div carousel-item>
        <div>条目1</div>
        <div>条目2</div>
        <div>条目3</div>
        <div>条目4</div>
        <div>条目5</div>
      </div>
</div>
<?php $__env->startSection('content'); ?>
<div id="article"></div>
<?php $__env->stopSection(); ?>
<script>
layui.use(['carousel','flow'], function(){
	  var $ = layui.jquery
	       carousel = layui.carousel
	       flow = layui.flow;

	  flow.load({
		    elem: '#article'
		    ,isAuto:false
		    ,isLazyimg:true	
		    ,done: function(page, next){
		      var lis = [];
		      $.post('/api/getArticles',{page:page}, function(res){
		        layui.each(res.data, function(index, item){
		        	var str= '';
		        	str += '<div class="main-left-article"><div class="title">';
		        	str += '<span class="layui-btn layui-btn-danger">' +item.category+ '</span>'
		        	str += '<span style="font-size:24px;margin-left:10px;"><a href="/detail/'+item.aid+'.html">' +item.title.substr(0, 25)+ '</a></span>'
		        	str += '</div><hr>'
		        	str += '<div class="content"><div class="image">'
		            str +='<img lay-src="' + item.thumb_img + '"/></div>';
					str +='<div class="intro">' + item.intro+ '</div></div><hr>'
		        	str += '<div style="width:100%;margin:0 auto;"><span class="layui-btn layui-btn-warm info">'
		        	str += '<span ><i class="fa fa-clock-o"></i>&nbsp;' +item.created_at+ '</span>'	
		        	str += '<span ><i class="fa fa-user-o"></i>&nbsp;' +item.author+ '</span>'
		        	str += '<span ><i class="fa fa-eye"></i>&nbsp;' +item.pv_number+ '</span>'
		        	str += '<span ><i class="fa fa-tags"></i>&nbsp;' +getTags(item.tags)+ '</span>'
		        	str += '<span ><i class="fa fa-comment-o"></i>&nbsp;' +item.comment_number+ '</span>'
		        	str += '</span>'
					str += '<a href="/detail/'+item.aid+'.html">'
			       	str +='<span class="layui-btn layui-btn-warm" style="float:right;">read more</span></a>'	
		        	str += '</div></div>'
		            lis.push(str);
		        }); 
		        next(lis.join(''), page < res.pages);    
		      });
		    }
		  });

	  //获取标签
	  function getTags(tag)
	  {
		 var  tags = tag.split(',');
	     var tag_str = '';
	     for (i=0;i<tags.length ;i++ ) 
         { 
            tag_str += '<a href="/tag/'+tags[i]+'">'+tags[i] + '</a>&nbsp';
        	
         }
	     return tag_str;
	  }
	  
	  /* //轮播图
	  carousel.render({
	    elem: '#carousel'
	    ,width: '100%' //设置容器宽度
	    ,arrow: 'always' //始终显示箭头
	    ,anim: 'fade' //切换动画方式
	  }); */
	  	
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>