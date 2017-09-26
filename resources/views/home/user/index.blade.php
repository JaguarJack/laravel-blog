@extends('layouts.user')
@section('title','分享')
@section('content')
<div class="share">
	<div class="title">分享发布</div>
	<a href="{{ url('write') }}">
	<div class="btn"><i class="fa fa-pencil"></i> 分享所思所闻</div>
	</a>
</div>
<div class="write">
	<div class="title">最新发布</div>
	<div>
		<ul>
		@foreach ($articles as $article) 
			<li>
    			<span class="layui-badge-dot layui-bg-orange"></span>&nbsp;&nbsp;
    			<a href="{{ url('detail',['id' => $article->id])}}.html"> {{ $article->title }}</a>&nbsp;&nbsp;
    			<span class="info"><a href="javascript:;">{{ $article->category }}</a> · 点赞   0 · 收藏  0 · 评论  0 · 发表于 2017-09-26</span>
    		</li>
    	@endforeach
    	</ul>
		<div class="no-article" style="display:none;">空空如也~</div>
	</div>
</div>
<div class="reply">
	<div class="title">最新评论</div>
	<div>
    	<ul>
    	    @foreach ($comments as $comment)
    			<li>
        			<span style="font-size:13px;opacity:0.6;">在</span>&nbsp;
        			<a href="{{url('detail',['id' => $comment->aid])}}.html#reply{{$comment->id}}">{{ $comment->title }}</a>&nbsp;
        			<span class="info">at {{ $comment->created_at }} · 评论</span>
    				<div class="reply-info">{!! $comment->content !!}</div>
        		</li>
    		@endforeach
    	</ul>
	<div class="no-reply" style="display:none;">空空如也~</div>
		
	</div>
</div>
@endsection