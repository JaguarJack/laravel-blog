@extends('layouts.user')
@section('title','首页')
@section('keywords', '首页')
@section('description', '首页')
@section('content')
<div class="user-nav">
	<a href="{{ url('user/center') }}"> 个人中心 </a>  <span style="opacity:0.5;">\ 参与评论</span>
</div>
<div class="share">
	<div class="title">评论 ({{ $total }})</div>
	<div>
		@if ($total)
			<ul class="layui-timeline" id="user_comment">
            </ul>
            <div id="page"></div>
        @else
			<div class="no-article">空 空 如 也  ~</div>
		@endif
	</div>
</div>
<script>
   layui.use(['laypage','jquery'], function(){
      var laypage = layui.laypage
      		$     = layui.jquery;
      laypage.render({
        elem: "page"
        ,count: "{{ $total }}"
        ,jump: function(obj, first){
            $.get('/getComments', {page:obj.curr,user_id:"{{ $id }}"} ,function(data){
				var str = '';
				var data = data.data;
				for (i=0;i < data.length;i++) {
					str += '<li class="layui-timeline-item">';
					str += '<i class="layui-icon layui-timeline-axis">&#xe63f;</i>'
    			    str += '<div class="layui-timeline-content layui-text">'
    				str += '<h3 class="layui-timeline-title">'+data[i].title+'中</h3>'
    				str += '<p>at '+data[i].created_at+' 评论<br>'+data[i].content
    				str += '<br><a href="/detail/'+data[i].aid+'#reply'+data[i].id+'">查看详情</a></p>'
    				str += '</div></li>';
				}
				$('#user_comment').html(str);
            })
      	}
    });
   })
</script>
@endsection