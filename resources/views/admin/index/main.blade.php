<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>NJPHPER BLOG-@yeild('title')</title>
  <link rel="stylesheet" href="{{ asset('/assets/layui/css/layui.css') }}" media="all">
  <script src="{{ asset('/assets/layui/layui.js') }}"></script>
  <style>
    #container{width:98%;margin-left:15px;padding-top:10px;}
    .form{margin:100px auto;width:500px;}
  </style>
</head>
    <body>
     <div id="container">
     	<div style="float:left;width:50%;min-height:500px;">
     		<ul class="layui-timeline">
                  <li class="layui-timeline-item">
                    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                    <div class="layui-timeline-content layui-text">
                      <h3 class="layui-timeline-title">9月14日</h3>
                      <p>
                       	NJPHPER BLOG BASE ON LARAVEL5.5。
                        <br>版本1.0。
                        <br>基础功能实现 <i class="layui-icon"></i>
                      </p>
                    </div>
                  </li>
                  <li class="layui-timeline-item">
                    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                  </li>
            </ul>
     	</div>
     	<div style="float:left;width:49%;min-height:500px;">
     		<table class="layui-table" lay-skin="line">
  <colgroup>
    <col width="200">
    <col width="250">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>基本信息</th>
      <th></th>
    </tr> 
  	</thead>
  	<tbody>
        <tr>
          <td>博客版本</td>
          <td>{{ config('home.version') }}</td>
        </tr>
        <tr>
          <td>PHP版本</td>
          <td>{{ PHP_VERSION }}</td>
        </tr>
        <tr>
          <td>Mysql版本</td>
          <td>{{ mysqli_get_client_version() }}</td>
        </tr>
        <tr>
          <td>服务器信息</td>
          <td>{{ $_SERVER ['SERVER_SOFTWARE'] }}</td>
        </tr>
        <tr>
          <td>操作系统</td>
          <td>{{ PHP_OS }}</td>
        </tr>
        <tr>
          <td>opcache(建议开启)</td>
          @if (function_exists('opcache_get_configuration'))
          <td>{{ opcache_get_configuration()['directives']['opcache.enable'] ? '开启' : '关闭' }}</td>
          @else
          <td>未开启</td>
          @endif
        </tr>
        <tr>
          <td>脚本最大执行时间(s)</td>
          <td>{{ get_cfg_var("max_execution_time") }}</td>
        </tr>
        <tr>
          <td>上传限制大小(M)</td>
          <td>{{ get_cfg_var ("upload_max_filesize") }}</td>
        </tr>
        <tr>
          <td>当前时间</td>
          <td>{{ date("Y-m-d H:i:s") }}</td>
        </tr>
        <tr>
          <td>已开启扩展</td>
          <td>
          	@foreach(get_loaded_extensions() as $vo)
          		【{{ $vo }}】
          	@endforeach
          </td>
        </tr>
        
      </tbody>
    	</table>
     	</div>
     </div>
    </body>
</html>


