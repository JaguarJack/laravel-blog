@extends('layouts.user')
@section('title','首页')
@section('keywords', '首页')
@section('description', '首页')
@section('content')
<div class="user-nav">
	<a href="{{ url('user/center') }}"> 个人中心 </a>  <span style="opacity:0.5;">\ 个人分享</span>
</div>
<div class="share">
	<div class="title">已分享({{ $total }})~</div>
		<ul class="layui-timeline" id="user_share">
          <li class="layui-timeline-item">
            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
            <div class="layui-timeline-content layui-text">
              <h3 class="layui-timeline-title">8月18日</h3>
              <p>
                layui 2.0 的一切准备工作似乎都已到位。发布之弦，一触即发。
                <br>不枉近百个日日夜夜与之为伴。因小而大，因弱而强。
                <br>无论它能走多远，抑或如何支撑？至少我曾倾注全心，无怨无悔 <i class="layui-icon"></i>
              </p>
            </div>
          </li>
        </ul>
	<!-- <a href="javascript:;">
	<div class="btn"><i class="fa fa-pencil"></i> 分享所思所闻</div>
	</a> -->
	<div id="page"></div>
</div>
<script>
   layui.use(['laypage','jquery'], function(){
      var laypage = layui.laypage
      		$     = layui.jquery;
      laypage.render({
        elem: "page"
        ,count: "{{ $pages }}"
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