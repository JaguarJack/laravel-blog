@extends('layouts.user')
@section('title','Ta的关注')
@section('content')
<div class="user-nav">
	<a href="{{ url('user/center') }}"> 个人中心 </a>  <span style="opacity:0.5;">\ 个人关注</span>
</div>
<div class="write">
	<div class="title">个人关注({{ $total }})</div>
	<div>
	@if ($total)
		<ul id="user_attend">
	
    	</ul>
    	<div id="page"></div>
    @else 
		<div class="no-article">空空如也~</div>
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
            $.get('/getAttend', {page:obj.curr,user_id:"{{ $id }}"} ,function(data){
				var str = '';
				var data = data.data;
				for (i=0;i < data.length;i++) {
					str += '<li>';
					str += '<span>'
				    str += '<img src="'+data[i].avatar+'" style="width:30px;height:30px;"></span>&nbsp;&nbsp;'
    			    str += '<a href="/user/'+data[i].id+'">'+data[i].user_name+'</a>&nbsp;&nbsp;--'
    				str += '<span class="info"><a href="javascript:;">'+data[i].introduction+'</span>'
    				str += '</li>';
				}
				$('#user_attend').html(str);
            })
      	}
    });
   })
</script>
@endsection