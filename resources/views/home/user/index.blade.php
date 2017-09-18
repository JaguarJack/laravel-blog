@extends('layouts.user')
@section('title','首页')
@section('keywords', '首页')
@section('description', '首页')
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
    			<a href="{{ url('detail',['id' => $article->id])}}"> {{ $article->title }}</a>&nbsp;&nbsp;
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
@endsection