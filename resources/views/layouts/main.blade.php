<!--
   01001001      01001100 01001111 01010110 00101101 00110010  00110000 00110010
   ________       ____________________________      __________________________________________
   |   _  \      |  ___    ____  __ _  \  |  |     |   __   _ _   \  |   _ _ _ _ _| |   _ _  \
   |  | \  \     |  |  |  |  |  |     \ \ |  |_ _ _|  | \  |     \ \ |  |           |  |    \ \
   |  |  \  \    |  |  |  |  |  |__ __/ / |   _ _ _   | |  |_ _ _/ / |  |__ _ _ __  |  |___ / /
   |  |   \  \   |  |  |  |  |  __ _ _ /  |  |     |  | |   _ _ _ /  |   ___ _ _ _| |   ____ \
   |  |    \  \  |  |  |  |  |  |         |  |     |  | |  |         |  |           |  |    \ \
   |  |     \  \_|  |_ |  |  |  |         |  |     |  | |  |         |  |_ _ _ ___  |  |     \ \
   |_ |      \____________|  |__|         |__|     |__| |__|         |__ _ _ _ ___| |__|      \_\
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
      	<li class="layui-nav-item"><a href="{{ url('category',['id' => $menu['id']]) }}">{{ $menu['name']}}</a>
      	
      	@if (count($menu[$menu['id']]))
          	<dl class="layui-nav-child"> <!-- 二级菜单 -->
          	@foreach($menu[$menu['id']] as $_menu)
              <dd><a href="{{ url('category',['id' => $_menu['id']]) }}">{{ $_menu['name']}}</a></dd>
    		@endforeach
		@endif
        </dl>
        </li>
      @endforeach
      </div>
      <span>
      @if (Auth::guard('home')->check())
           <li class="layui-nav-item">
           @inject('notice', 'App\Service\NoticeService')
            <a href="javascript:;">个人分享<span class="layui-badge">{{ $notice->getNotRead($user->id) }}</span></a>
            <dl class="layui-nav-child">
              <dd><a href="{{ url('write') }}"><i class="fa fa-cog"></i> 分享所闻</a></dd>
              <dd><a href="{{ url('user/notice') }}"><i class="fa fa-power-off"></i> 消息通知</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item">
            <a href="javascript:;"><img src="{{ $user->avatar }}" class="layui-nav-img">{{ $user->user_name }}</a>
            <dl class="layui-nav-child">
              <dd><a href="{{ url('user', ['id' => $user->id ]) }}"><i class="fa fa-cog"></i> 个人中心</a></dd>
              <dd><a href="{{ url('user/edit') }}"><i class="fa fa-power-off"></i> 编辑资料</a></dd>
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
