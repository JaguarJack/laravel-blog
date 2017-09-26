@extends('layouts.main')
@section('title', $article_info->title)
@section('keywords', config('home.site.keywords'))
@section('description', config('home.site.description'))
@section('class', 'detail')
@section('main')

<div class="blog_detail">
<div class="content" id="markdown">
	<div class="title">
	<span>{{ $article_info->title }}</span>
	<div style="margin-left:2em;height:55px;">
		<div>
			<img src="{{ $article_info->avatar }}">
		<div style="width:400px;height:50px;float:left;">
			<button class="layui-btn-primary layui-btn-mini" style="margin-left:-10px;">作者</button> 
			<a href="{{ url('user', ['id' => $article_info->user_id])}}" style="color:green;font-size:16px;">{{ $article_info->author }}</a>&nbsp;&nbsp;<span style="font-size:12px; opacity:0.5;">{{ $article_info->introduction }}</span>
			<p>			
				*{{ $article_info->created_at }}  收藏 {{$article_info->store_number}}  
				评论 {{$article_info->comment_number}}  喜欢 {{$article_info->like_number}}  阅读<span class="pv" style="font-size:13px;"> {{$article_info->pv_number }}</span>
			</p>
		</div>
	</div>
	</div>
	</div>
	<div class="article-content">
		{!! htmlspecialchars_decode($article_info->content) !!}
	</div>
	<div class="article-author">
		<div class="author-intro">
			<div class="author-avatar">
				<img src="{{ $article_info->avatar }}">
			</div>
			<div style="width:70%;margin-left:5px;float:left;">
				<p style="margin-bottom: 0px;">
					<span style="font-weight: 500;"><a href="{{ url('user', ['id' => $article_info->user_id])}}" style="color:green;font-size:16px;">{{ $article_info->author }}</a></span>
					<span style="font-size:12px; opacity:0.5;">{{ $article_info->introduction }}</span>
				</p>
				<p style="margin-bottom: 0px;">
				@if ($article_info->github_homepage)
        			<a href="{{ $article_info->github_homepage }}" target="_blank">
        				<span class="layui-btn layui-btn-radius layui-btn-mini layui-btn-primary" data="{{ $article_info->github_name ? : $article_info->github_homepage }}" ><i class="fa fa-github" aria-hidden="true"></i> github</span>
        			</a>
    			@endif
    			@if ($article_info->sina_homepage)
        			<a href="{{ $article_info->sina_homepage }}" target="_blank">
        				<span class="layui-btn layui-btn-radius layui-btn-mini layui-btn-primary" data="{{ $article_info->sina_name ? : $article_info->sina_homepage }}" ><i class="fa fa-weibo" aria-hidden="true"></i> 微博</span>
        			</a>
    			@endif
    			@if ($article_info->website)
        			<a href="{{ $article_info->website }}" target="_blank">
        				<span class="layui-btn layui-btn-radius layui-btn-mini layui-btn-primary" data="{{ $article_info->website }}" ><i class="fa fa-globe" aria-hidden="true"></i> 个人网站</span>
        			</a>
    			@endif
    			@if ($article_info->city)
        			<a href="javascript:;">
        				<span class="layui-btn layui-btn-radius layui-btn-mini layui-btn-primary" data="{{ $article_info->city }}" ><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $article_info->city }}</span>
        			</a>
    			@endif
				</p>
			</div>
			<div class="shuming">
					@if (!$attented)   
    					<button class="layui-btn attend">关注</button>
    				@else
    					<button class="layui-btn layui-btn-primary attend">已关注</button>
    				@endif
				
			</div>
			
		</div>
		<div style="clear:both;"></div>
		<div style="min-height:50px;padding-top:10px;text-indent:1em;opacity:0.5;">{{ $article_info->signature }}</div>
	</div>
</div>
	<div style="width:100%;height:50px;background-color:#fff;">
		<div style="width:50%;height:50px;margin:0 auto;text-align:center;">
		@if (!$liked) 
			<span class="layui-btn layui-btn-radius layui-btn-primary like">喜欢  <span>{{ $article_info->like_number }}</span></span>		
		@else
		    <span class="layui-btn layui-btn-radius like">喜欢   <span>{{ $article_info->like_number }}</span></span>
		@endif
		@if (!$stored)
			<span class="layui-btn layui-btn-radius layui-btn-primary store">收藏   <span>{{ $article_info->store_number }}</span></span>
		@else
			<span class="layui-btn layui-btn-radius store">收藏   <span>{{ $article_info->store_number }}</span></span>
		@endif
		</div>
	</div>
	<div style="width:100%;min-height:50px;background-color:#fff;">
	@if ($preNext[1])
	<a href="{{ url('detail', ['id' => $preNext[1]->id])}}">
		<button class="layui-btn layui-btn-small layui-btn-danger"><i class="fa fa-arrow-left"></i>&nbsp;{{ $preNext[1]->title }}</button>
	</a>
	@endif
	@if ($preNext[0])
	<a href="{{ url('detail', ['id' => $preNext[0]->id])}}">	
		<button class="layui-btn layui-btn-small layui-btn-danger" style="float:right;">{{ $preNext[0]->title }}&nbsp;<i class="fa fa-arrow-right"></i></button>
	</a>
	@endif
	</div>
<div class="comment">
	<div class="reply">已回复评论(<span class="comment_number">{{ $article_info->comment_number }}</span>)<a name="reply{{ $article_info->id }}" id="reply{{ $article_info->id }}" href="#reply{{ $article_info->id }}"></a></div>
	<div class="info">	
	<ul class="comment_content" id="comments">

		</ul>
	
	</div>
	<div style="clear:both;"></div>
</div>
<div class="editor">
<textarea id="edit" name="comment" style="width:99%;border:1px solid #e6e6e6;border-radius:5px;min-height:100px;padding:5px 5px;"></textarea>
<button class="layui-btn submit_comment">回复</button>
</div>
<input type="hidden" name="reply_user" value="0">
</div>        		
<script src="{{ asset('/assets/markdown/js/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/assets/markdown/css/editormd.preview.css') }}" />	
<script src="{{ asset('/assets/markdown/lib/marked.min.js') }}"></script>
<script src="{{ asset('/assets/markdown/lib/prettify.min.js') }}"></script>
<script src="{{ asset('/assets/markdown/lib/raphael.min.js') }}"></script>
<script src="{{ asset('/assets/markdown/lib/underscore.min.js') }}"></script>
<script src="{{ asset('/assets/markdown/lib/sequence-diagram.min.js') }}"></script>
<script src="{{ asset('/assets/markdown/lib/flowchart.min.js') }}"></script>
<script src="{{ asset('/assets/markdown/lib/jquery.flowchart.min.js') }}"></script>
<script src="{{ asset('/assets/markdown/js/editormd.js') }}"></script>
<style>
    .editormd-html-preview {padding:0px;}    
</style>
<script>
var aid = "{{ $article_info->id}}";
var attend_user_id = "{{ $article_info->user_id }}";
layui.use(['jquery','layer', 'flow'], function(){
	  var $ = layui.jquery
	  layer = layui.layer
	  flow  = layui.flow;

	    $(function() {
    		  $.get("{{url('api/increasePv')}}", {aid:aid}, function(response){
    				if (response.code == 10000) {
						$('.pv').html(parseInt($('.pv').html()) + 1)	
        			}
    		  })
	    })
		flow.load({
		    elem: '#comments'
			,scrollElem:'#comments'
		    ,isAuto:true
		    ,isLazyimg:true
		    ,end:'没有啦~'
		    ,done: function(page, next){
		      var lis = [];
		      $.get('/getArticleComment',{page:page, aid: "{{ $article_info->id }}"}, function(res){
		        layui.each(res.data, function(index, item){
		        	var str= '';
		        	str += '<li><div class="avatar">'
					str +='	<img src="'+ item.avatar +'"/>'
					str +='</div>'
					str += '<div class="comment-info">'
					str +=	'<div style="min-height:40px;">'
					str += '<div><span  class="span-left" data="'+item.user_id+'"><a href="/user/'+item.user_id+'">'+item.user_name+'</a></span>'
					str +=	'<a href="javascript:;"><span class="span-right" data="'+item.user_id +'" name="'+ item.user_name +'"><i class="fa fa-mail-reply"></i> 回复</span>'
					str +='</a></div><div class="time"><a name="reply'+item.id+'" id="reply'+ item.id +'" href="#reply'+ item.id+ '"></a>'+ item.created_at
					str +='</div></div><p>' +item.content +'</p></div></li>'
		        	
		            lis.push(str);
		        }); 
		        next(lis.join(''), page < res.pages);    
		      });
		    }
		  });
		$('#edit').focus(function(){
			$(this).css('border','1px solid green')
		});
		$('#edit').blur(function(){
			$(this).css('border','1px solid #e6e6e6')
		});
		
		$('.comment_content').on('click', '.span-right' ,function(){
			var user_id = $(this).attr('data');
			var name    = $(this).attr('name');
			var html    = '@'+name+' ';
			$('#edit').val(html);
			$('input[name=reply_user]').val(user_id);
			$('#edit').focus();
	    });

	    $('.submit_comment').click(function(){
			var reply_user = $('input[name=reply_user]').val();
			var aid        = "{{ $article_info->id }}"
			var content    = $('#edit').val();
			if (content.length < 1) { layer.msg('请输入评论内容'); return false;}
			$.post('/comment', {reply_user:reply_user, aid:aid, content:content},function(response){
					if (response.status == 10000) {
						if($('.comment_content .no-comment').length) {$('.no-comment').remove();}
						var str='';
						str += '<li>';
						str += '<div class="avatar">';
						str += '<img src="'+response.data.avatar+'"/>';
						str += '</div>';
						str += '<div class="comment-info"><div style="min-height:40px;"><div>';
						str += '<span  class="span-left" data="'+response.data.user_id+'"><a href="javascript:;">'+response.data.user_name+'</a></span>'
						str += '<a href="javascript:;">'
						str += '<span class="span-right" data="'+response.data.user_id+'" name="'+response.data.user_name+'"><i class="fa fa-mail-reply"></i> 回复</span>'
						str += '</a>'
						str += '</div><div class="time">'
						str += '<a name="reply'+response.data.id+'"href="#reply'+response.data.id+'">#'+(parseInt($('.comment_content').children('li').length)+1)+'</a> '+response.data.created_at
						str += '</div></div>'
						str += '<p>'+response.data.content+'</p>'
						str += '</div></li>'
						$('.layui-flow-more').before(str);
						$('.comment_number').html(parseInt($('.comment_number').html()) + 1);
						$('#edit').val('');
					} else {
						layer.msg(response.msg);
				    }
			})

		})
		//$('.span-left').mouseover(function(){
			//layer.tips('只想提示地精准些', $(this), {
				//tips: 1
			//});
		//});

	    $('.like').click(function(){
			$.post("{{ url('api/like')}}",{aid:aid,api_token:"{{ Auth::guard('home')->user()->api_token ?? '' }}"}, function(response){
					if (response.code == 10000) {
						var number = $('.like span').html();
						if ($('.like').hasClass('layui-btn-primary')) {
							$('.like').removeClass('layui-btn-primary');
							$('.like span').html(parseInt(number) + 1);
						} else {
							$('.like').addClass('layui-btn-primary');
							$('.like span').html(parseInt(number) - 1);
						}
					}
		    })
		})

		$('.store').click(function(){
			$.post("{{ url('api/store')}}",{aid:aid,api_token:"{{ Auth::guard('home')->user()->api_token ?? '' }}"}, function(response){
    				var number = $('.store span').html();
    				if ($('.store').hasClass('layui-btn-primary')) {
    					$('.store').removeClass('layui-btn-primary');
    					$('.store span').html(parseInt(number) + 1);
    				} else {
    					$('.store').addClass('layui-btn-primary');
    					$('.store span').html(parseInt(number) - 1);
    				}
		    })
		})
		
		$('.attend').click(function(){
			$.post("{{ url('api/attend')}}",{attend_user_id:attend_user_id,api_token:"{{ Auth::guard('home')->user()->api_token ?? '' }}"}, function(response){
					if (response.code == 10000) {
						//为关注状态
							if($('.attend').hasClass('layui-btn-primary')){
								$('.attend').removeClass('layui-btn-primary').html('关注');
							} else {
								$('.attend').addClass('layui-btn-primary').html('已关注');	
							}
					}
													
					
		    })
		})
		$('.layui-btn-mini').hover(function(){
			if(typeof($(this).attr("data"))!= "undefined") {
				layer.tips($(this).attr('data'),$(this),{tips:1});
			}
  		});
	
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

@endsection
