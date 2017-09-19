@extends('layouts.main')
@section('main')
<script src="{{ asset('/assets/layui/layui.js') }}"></script>
    <div class="user">
        <div class="user-left">
        	<div class="user-card">
        		<div class="name">author</div>
        		<div class="avatar">
        			<img src="https://dn-phphub.qbox.me/uploads/avatars/18206_1502242007.png?imageView2/1/w/200/h/200">
        		</div>
        		<hr/>
        		<div class="intro">
        			<div><span class="layui-badge-dot layui-bg-gray"></span> 第 18206 位会员</div>
        			<div><span class="layui-badge-dot layui-bg-gray"></span> 注册at 2017-09-25</div>
         			<div><span class="layui-badge-dot layui-bg-gray"></span> 最近登录 2017-89-63</div>
        		</div>
        		<a href="{{ url('/user/edit') }}">
        		<span class="layui-btn layui-btn-primary"><i class="fa fa-pencil-square-o"></i> 编 辑 资 料</span>
        		</a>
        	</div>
        	<div class="user-relate">
        	    <a href="{{ url('/user/share', ['id' => $id]) }}">
        			<span class="layui-btn layui-btn-primary"><i class="fa fa-pencil"></i> Ta 发布的文章</span>
        		</a>
        		<a href="{{ url('/user/comment', ['id' => $id]) }}">
        			<span class="layui-btn layui-btn-primary"><i class="fa fa-comments-o"></i> Ta 发表的评论</span>
        		</a>
        		<a href="{{ url('/user/attend', ['id' => $id]) }}">
        			<span class="layui-btn layui-btn-primary"><i class="fa fa-eye"></i> Ta 关注的用户</span>
        		</a>
        		<a href="{{ url('/user/like', ['id' => $id]) }}">
        			<span class="layui-btn layui-btn-primary"><i class="fa fa-thumbs-up"></i> Ta 赞过的文章</span>
        		</a>
        		<a href="{{ url('/user/store', ['id' => $id]) }}">
        			<span class="layui-btn layui-btn-primary"><i class="fa fa-plus-square-o"></i> Ta 收藏的文章</span>
        		</a>
        		
        	</div>
        </div>
        <div class="user-right">
        	@yield('content')
        </div>
        <div style="clear:both;"></div>
    </div>

<script>
//注意：导航 依赖 element 模块，否则无法进行功能性操作
layui.use(['element'], function(){
  var element = layui.element;
});
</script>
@endsection