<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>NJPHPER BLOG-@yeild('title')</title>
  <link rel="stylesheet" href="{{ asset('/assets/layui/css/layui.css') }}" media="all">
  <style>
    #container{width:98%;margin-left:15px;padding-top:10px;}
    .form{margin:100px auto;width:500px;}
  </style>
</head>
    <body>
     <div id="container">
     	首页 / @yield('menu1') / @yield('menu2')
     	<hr class="layui-bg-green">
      	@yield('content')
     </div>
    </body>
</html>
