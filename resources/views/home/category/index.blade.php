@extends('layouts.home')
@section('title','首页')
@section('keywords', '首页')
@section('description', '首页')
@section('class', 'main')
@section('content')
<div id="article">

</div>
@endsection
@section('page')
@if ($total)
<div id="page"></div>
@endif
<script>
   layui.use(['laypage','jquery'], function(){
      var laypage = layui.laypage
      		$     = layui.jquery;
      laypage.render({
        elem: "page"
        ,count: "{{ $total }}"
        ,jump: function(obj, first){
            $.get('/getCategory', {page:obj.curr,category_id:"{{ $id }}"} ,function(data){
                var data = data.data;
                var str= '';
                for (var i=0; i < data.length; i++) {
    	        	str += '<div class="main-left-article"><div class="title">';
    	        	str += '<span class="layui-btn layui-btn-danger">' +data[i].category+ '</span>'
    	        	str += '<span style="font-size:24px;margin-left:10px;"><a href="/detail/'+data[i].aid+'">' +data[i].title.substr(0, 25)+ '</a></span>'
    	        	str += '</div><hr>'
    	        	str += '<div class="content"><div class="image">'
    	            str +='<img lay-src="' + data[i].thumb_img + '"/></div>';
    				str +='<div class="intro">' + data[i].intro+ '</div></div><hr>'
    	        	str += '<div style="width:95%;margin:0 auto;"><span class="layui-btn layui-btn-warm info">'
    	        	str += '<span ><i class="fa fa-clock-o"></i>&nbsp;' +data[i].created_at+ '</span>'	
    	        	str += '<span ><i class="fa fa-user-o"></i>&nbsp;' +data[i].author+ '</span>'
    	        	str += '<span ><i class="fa fa-tags"></i>&nbsp;' +data[i].pv_number+ '</span>'
    	        	str += '<span ><i class="fa fa-eye"></i>&nbsp;' +getTags(data[i].tags)+ '</span>'
    	        	str += '<span ><i class="fa fa-comment-o"></i>&nbsp;' +data[i].comment_number+ '</span>'
    	        	str += '</span><span class="layui-btn layui-btn-warm" style="float:right;">read more</span>'	
    	        	str += '</div></div>'
                }
                if (str.length) {
					$('#article').html(str);
                } else {
                	$('#article').html('<div style="margin:100px auto;width:30%;font-size:16px;">空 空 如 也~</div>');
                }
            })
      	}
    });

      //获取标签
	  function getTags(tag)
	  {
		 var  tags = tag.split(',');
	     var tag_str = '';
	     for (i=0;i<tags.length ;i++ ) 
         { 
            tag_str += '<a href="/tag/'+tags[i]+'">'+tags[i] + '</a>&nbsp';
        	
         }
	     return tag_str;
	  }
   })
</script>  
@endsection