@extends('layouts.user')
@section('title','Ta的分享')
@section('content')
<div class="user-nav">
	<a href="{{ url('user/center') }}"> 个人中心 </a>  <span style="opacity:0.5;">\ 个人分享</span>
</div>
@if ($draft && Auth::guard('home')->user() && Auth::guard('home')->user()->id == $id)
<div class="draft">
	<div class="title">未发布({{ count($draft) }})</div>
	<ul>
		@foreach ($draft as $article) 
			<li>
    			<span class="layui-badge-dot layui-bg-orange"></span>&nbsp;&nbsp;
    			<a href="{{ url('draft',['id' => $article->id])}}"> {{ $article->title }}</a>&nbsp;&nbsp;
    			<span class="info"><a href="javascript:;">{{ $article->category }}</a> · 发表于 {{ $article->created_at }}</span>
    		</li>
    	@endforeach
    	</ul>
</div>
@endif
<div class="share">
	<div class="title">已分享({{ $total }})</div>
	@if($total)
		<ul class="layui-timeline" id="user_share">
       	
        </ul>
        <div id="page"></div>
    @else
    	<a href="{{ url('write') }}">
    		<div class="btn"><i class="fa fa-pencil"></i> 分享所思所闻</div>
    	</a>
	@endif
</div>
<script>
   layui.use(['laypage','jquery'], function(){
      var laypage = layui.laypage
      		$     = layui.jquery;
      laypage.render({
        elem: "page"
        ,count: "{{ $total }}"
        ,jump: function(obj, first){
            $.get('/getUserArticles', {page:obj.curr,user_id:"{{ $id }}"} ,function(data){
				var str = '';
				var data = data.data;
				for (i=0;i < data.length;i++) {
					str += '<li class="layui-timeline-item">';
					str += '<i class="layui-icon layui-timeline-axis">&#xe63f;</i>'
    			    str += '<div class="layui-timeline-content layui-text">'
    				str += '<h3 class="layui-timeline-title">'+data[i].title+'</h3>'
    				str += '<p>发表于:'+data[i].created_at+'<br>'+data[i].intro+'</p>'
    				str += '</div></li>';
				}
				$('#user_share').html(str);
            })
      	}
    });
   })
</script>
@endsection