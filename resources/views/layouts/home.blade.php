@extends('layouts.main')
@section('title', config('home.site.title'))
@section('keywords', config('home.site.keywords'))
@section('description', config('home.site.description'))
@section('class', 'main')
@section('main')
    <div class=@yield("class")>
        @yield('carousel')
        <div class="main-left" >
        	@yield('content')
        	@yield('page')
        </div>
        <div class="main-right">
        	<div class="tab">
              <div class="title">热门推荐</div>
              <div class="layui-tab-content" style="min-height: 100px;background-color:white;">
                <div class="layui-tab-item layui-show hotArticles">
                
                </div>
              </div>
            </div>
            <div class="tab">
              <div class="title">技术站点</div>
              <div class="layui-tab-content" style="min-height: 100px;background-color:white;">
                <div class="layui-tab-item layui-show technology"></div>
              </div>
            </div>
            <div class="tab">
              <div class="title">标签列表</div>
              <div class="layui-tab-content" style="min-height: 100px;background-color:white;">
                <div class="layui-tab-item layui-show tags">
				</div>
              </div>
            </div>
            <div class="tab">
              <div class="title">友情链接</div>
              <div class="layui-tab-content" style="min-height: 100px;background-color:white;">
                <div class="layui-tab-item layui-show friendly"></div>
              </div>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
<script>
layui.use('jquery', function(){
	  var $ = layui.jquery;
	  $.get('/api/getTags',function(response){
			var data = response.data;
			var str  = '';
			for(var i = 0; i < data.length; i++) {
				str += '<a href="/tag/'+data[i].name+'" target="_blank">'
				str += '<span class="layui-btn layui-btn-primary" style="margin-top:5px;margin-left:5px;">'+data[i].name+'</span>'
				str += '</a>'
			}

			$('.tags').html(str);
	  })

	   $.get('/api/getHotArticles',function(response){
			var data = response.data;
			var str  = '';
			for(var i = 0; i < data.length; i++) {
				str += '<span class="layui-badge-dot layui-bg-orange"></span>&nbsp;&nbsp;'
				str += '<a href="/detail/'+data[i].id+'" target="_blank">'+data[i].title
				str += '<hr></a>'
			}
			$('.hotArticles').html(str);
	  })

	  $.get('/api/getAllLinks',function(response){
			var data = response.data;
			var str  = '';
			var _str = '';
			for(var i = 0; i < data.length; i++) {
					
				if (data[i].type == 1) {
					str += '<span class="layui-badge-dot layui-bg-orange"></span>&nbsp;&nbsp;'
					str += '<a href="'+data[i].url+'" target="_blank">'+data[i].title
					str += '<hr></a>'
				} else {
					_str += '<span class="layui-badge-dot layui-bg-orange"></span>&nbsp;&nbsp;'
					_str += '<a href="'+data[i].url+'" target="_blank">'+data[i].title
					_str += '<hr></a>'
				}
			}
			$('.technology').html(_str);
			$('.friendly').html(str);
	  })
});
</script>
@endsection