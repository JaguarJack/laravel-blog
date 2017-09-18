@extends('layouts.home')
@section('title','首页')
@section('keywords', '首页')
@section('description', '首页')
@section('class', 'main')
@section('content')
<div class="main-left-article">
	<div class="title">
		<span class="layui-btn layui-btn-danger">分类</span>
		<span style="font-size:24px;">这是第一个标题</span>
	</div>
	<hr>
	<div class="content">
		<div class="image">
			<img src="http://www.xhuihui.cn/Uploads/Picture/2017-01-11/2275101018-586cbaed74d75_articlex.png"/>
		</div>
		<div class="intro">
			当打包构建应用时，Javascript 包会变得非常大，影响页面加载。如果我们能把不同路由对应的组件分割成不同的代码块，然后当路由被访问的时候才加载对应组件，这样就更加高效了。                                        
		</div>
	</div>
	<hr>
	<div style="width:95%;margin:0 auto;">
	<span class="layui-btn layui-btn-warm info">
		<span ><i class="fa fa-clock-o"></i>&nbsp;2017-09-11 10:13</span>
		<span ><i class="fa fa-user-o"></i>&nbsp;admin</span>
		<span ><i class="fa fa-tags"></i>&nbsp;89</span>
		<span ><i class="fa fa-eye"></i>&nbsp;78</span>
		<span ><i class="fa fa-comment-o"></i>&nbsp;89</span>
		</span>
		<span class="layui-btn layui-btn-warm" style="float:right;">read more</span>
	</div>
</div>        		
@endsection

@section('article-tab')
<div class="layui-tab tab">
  <ul class="layui-tab-title">
    <li class="layui-this" style="font-size:16px;opacity:0.5;">热门文章</li>
    <li style="font-size:16px;opacity:0.5;">最新文章</li>
  </ul>
  <div class="layui-tab-content" style="height: 100px;background-color:white;">
    <div class="layui-tab-item layui-show">1</div>
    <div class="layui-tab-item">2</div>
  </div>
</div>
@endsection