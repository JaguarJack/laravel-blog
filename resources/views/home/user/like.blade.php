@extends('layouts.user')
@section('title','Ta 喜欢的')
@section('content')
<div class="user-nav">
	<a href="{{ url('user/center') }}"> 个人中心 </a>  <span style="opacity:0.5;">\ 个人喜欢</span>
</div>
<div class="write">
	<div class="title">个人喜欢({{ $total }})</div>
		@if ($total)
            <ul class="layui-timeline" id="user-like"></ul>
    		<div id="page"></div>
		@else
			<div class="no-article">空 空 如 也  ~</div>
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
            $.get('/getLikeArticles', {page:obj.curr,user_id:"{{ $id }}"} ,function(data){
				var str = '';
				var data = data.data;
				for (i=0;i < data.length;i++) {
					str += '<li>';
					str += '<span><span class="layui-badge-dot layui-bg-orange"></span>&nbsp;&nbsp;'
    			    str += '<a href="/detail/'+data[i].aid+'">'+data[i].title+'</a>&nbsp;&nbsp;--&nbsp;&nbsp;'
    				str += '<span class="info">·<a href="/category/'+data[i].cid+'"> '+data[i].category+' · <a href="/user/'+data[i].aid+'">'+data[i].author+'</a></span>'
    				str += '</li>';
				}
				$('#user-like').html(str);
            })
      	}
    });
   })
</script>
@endsection