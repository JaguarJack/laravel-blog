@extends('layouts.main')
@section('title','首页')
@section('keywords', '首页')
@section('description', '首页')
@section('class', 'detail')
@section('main')
<div class="blog_detail">
<div class="content" id="markdown">
	<div class="title">
	<span>{{ $article_info->title }}</span>
	<div>
		<i class="fa fa-user-o"></i>{{ $article_info->author }} 发布与
		<i class="fa fa-clock-o"></i>{{ $article_info->created_at }}
		<i class="fa fa-tags"></i>
		<i class="fa fa-eye"></i>100
	</div>
	</div>
	<div class="article-content">
		{!! htmlspecialchars_decode($article_info->content) !!}
	</div>
</div>
	<div style="width:100%;height:50px;background-color:#fff;">
		<div style="width:50%;height:50px;margin:0 auto;text-align:center;">
		@if (!$liked) 
			<span class="layui-btn layui-btn-radius layui-btn-primary like"><i class="fa fa-thumbs-o-up"></i>&nbsp; 点赞  <span>{{ $article_info->like_number }}</span></span>		
		@else
		    <span class="layui-btn layui-btn-radius like"><i class="fa fa-thumbs-up"></i>&nbsp;点赞  <span>{{ $article_info->like_number }}</span></span>
		@endif
		@if (!$stored)
			<span class="layui-btn layui-btn-radius layui-btn-primary store">&nbsp;收藏  <span>{{ $article_info->store_number }}</span></span>
		@else
			<span class="layui-btn layui-btn-radius store"><i class="layui-icon">&#xe6c6;</i>&nbsp;收藏  <span>{{ $article_info->store_number }}</span></span>
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
	<div class="reply">已回复评论({{ $comments->count() }})</div>
	<div class="info">
	
	@if (!$comments->count())
		<div class="no-comment" >空空如也~快来成为第一个评论的人吧</div>
	@else	
	<ul>
		@foreach ($comments as $key => $comment)
			<li>
				<div class="avatar">
					<img src="{{ $comment->avatar }}"/>
				</div>
				<div class="comment-info">
					<div style="min-height:40px;">
					<div>
						<span  class="span-left" data="{{$comment->user_id}}"><a href="javascript:;">{{ $comment->user_name }}</a></span>
						<a href="javascript:;">
							<span class="span-right" data="{{ $comment->user_id }}" name="{{ $comment->user_name }}"><i class="fa fa-mail-reply"></i> 回复</span>
						</a>
						</div>
						<div class="time">
							<a href="{{ url('detail',['id' => $article_info->id ] )}}#reply{{ $comment->id }}">#{{ $key+1 }}</a> {{ $comment->created_at }}
						</div>
					</div>
					<p>{!! $comment->content !!}</p>
				</div>
			</li>
		 @endforeach
		</ul>
	 @endif		
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
  <div class="title">{{ $article_info->uname }}</div>
  <div class="layui-tab-content" style="min-height:100px;background-color:white;">
    <div class="layui-tab-item layui-show" style="min-height:200px;">
    
    	<div class="avatar">
    		<img src="{{ $article_info->head_img }}">
    	</div>
    	<div class="sign">
    	个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介个人简介
    	</div>
    	<hr/>
    	@if ($attented)
    		<a href="javascript:;"><div class="btn attend" style="background-color: #009688;">已关注</div></a>
    	@else
    		<a href="javascript:;"><div class="btn attend">关注</div></a>
    	@endif
    </div>
  </div>
</div>  -->
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
			var aid        = "{{ $article_info->id }}"
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
			$.post("{{ url('api/like')}}",{aid:aid,user_id:"{{ $user_id }}"}, function(response){
					if (response.code == 10000) {
						window.location.reload();
					}
		    })
		})

		$('.store').click(function(){
			$.post("{{ url('api/store')}}",{aid:aid,user_id:"{{ $user_id }}"}, function(response){
					if (response.code == 10000) {
						window.location.reload();
					}
		    })
		})
		
		$('.attend').click(function(){
			$.post("{{ url('api/attend')}}",{attend_user_id:attend_user_id,user_id:"{{ $user_id }}"}, function(response){
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

@endsection
