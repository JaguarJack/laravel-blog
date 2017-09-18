<!--
  
  
   
 -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title')-凝聚博客</title>
    <meta name="keywords" content= @yield("keywords") />
    <meta name="description" content= @yield("description") />
    <link rel="stylesheet" href="{{ asset('/assets/layui/css/layui.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/public.css') }}">
    <script src="{{ asset('/assets/layui/layui.js') }}"></script>
    <script>
    //注意：导航 依赖 element 模块，否则无法进行功能性操作
    layui.use(['element', 'util'], function(){
      var element = layui.element
      	  util    = layui.util;
      util.fixbar({});
    });
    </script>   
</head>
<body class="body">
    <ul class="layui-nav" lay-filter="filter-nav">
    <div class="nav">
     <div class="nav-right">
     <li class="layui-nav-item"><a href="/">首页</a>
      @foreach($menus as $menu)
      	<li class="layui-nav-item"><a href="javascript:;">{{ $menu['name']}}</a>
      	
      	@if (count($menu[$menu['id']]))
          	<dl class="layui-nav-child"> <!-- 二级菜单 -->
          	@foreach($menu[$menu['id']] as $_menu)
              <dd><a href="{{ url('/s/') }}">{{ $_menu['name']}}</a></dd>
    		@endforeach
		@endif
        </dl>
        </li>
      @endforeach
      </div>
      <span>
      @if (Auth::guard('home')->check())
           <li class="layui-nav-item">
            <a href="{{ url('user',['id' => Auth::guard('home')->user()->id ]) }}">个人中心<span class="layui-badge">99+</span></a>
          </li>
          <li class="layui-nav-item">
            <a href=""><img src="http://t.cn/RCzsdCq" class="layui-nav-img">{{ Auth::guard('home')->user()->user_name}}</a>
            <dl class="layui-nav-child">
              <dd><a href="javascript:;"><i class="fa fa-cog"></i> 编辑信息</a></dd>
              <dd><a href="javascript:;"><i class="fa fa-power-off"></i> 安全管理</a></dd>
              <dd><a href="{{ url('signout') }}"><i class="fa fa-power-off"></i> 退出</a></dd>
            </dl>
          </li>
         @else
           <li class="layui-nav-item">
           <a href="{{ url('signup') }}">注册</a>
          </li>
          <li class="layui-nav-item">
            <a href="{{ url('signin') }}">登录</a>
          </li>
          @endif 
      </span>
      </div>
    </ul>
    @yield('main')
    <div class="footer">
    </div>
</body>
</html>