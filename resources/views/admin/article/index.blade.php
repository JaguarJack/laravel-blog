@extends('layouts.admin')
@section('title','用户管理')
@section('menu1', '用户管理')
@section('content')
<blockquote class="layui-elem-quote">
<form class="layui-form">
    <div class="layui-input-inline">
      <input type="text" name="title" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-input-inline">
      <input type="text" name="user_name" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-input-inline">
      <select name="status">
        	<option value="0">请选择</option>
        	<option value="1">草稿</option>
        	<option value="2">待审核</option>
        	<option value="3">通过</option>
      </select>
    </div>
    <button class="layui-btn reload" onclick="return false;"><i class="layui-icon">&#xe615;</i>搜素</button>
</form>
</blockquote>
<table class="layui-table" lay-data="{height:600,width:1220, method:'post', url:'/api/getArticlesList', page:true,limit: 10, id:'table'}" lay-filter="table">
  <thead>
    <tr>
      <th lay-data="{field:'id', align:'center',width:80, sort: true}">ID</th>
      <th lay-data="{field:'title', align:'center',width:300}">标题</th>
      <th lay-data="{field:'category', align:'center',width:100}">分类</th>
      <th lay-data="{field:'author', align:'center',width:80}">作者</th>
      <th lay-data="{field:'tags', align:'center',width:150}">标签</th>
      <th lay-data="{field:'status', align:'center',width:100}">状态</th>
      <th lay-data="{field:'created_at', align:'center',width:200}">创建时间</th>
      <th lay-data="{fixed: 'right', width:200, align:'center', toolbar: '#option'}">操作</th>
    </tr>
  </thead>
</table>
@endsection
<script src="{{ asset('/assets/layui/layui.js') }}"></script>
<script type="text/html" id="option">
<a class="layui-btn layui-btn-mini" lay-event="pass">审核</a>
<a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="notpass">不通过</a>
</script>
<script>
layui.use(['laytpl', 'table'], function(){
  var table = layui.table
  	   form  = layui.form
  	 laytpl = layui.laytpl
	   $    = layui.jquery;
  table.render({ //其它参数在此省略
	  skin: 'line' //行边框风格
	  ,size: 'sm' //小尺寸的表格
	  
	});

  table.on('tool(table)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
	  var data = obj.data; //获得当前行数据
	  var layEvent = obj.event; //获得 lay-event 对应的值
	  var tr = obj.tr; //获得当前行 tr 的DOM对象
	    //do somehing
	  if(layEvent === 'notpass'){ //删除
	    layer.confirm('确 定 ?', function(index){
		var token = "{{ csrf_token() }}"
	      $.post("{{ url('article/notPass') }}", {id:data.id, _token:token}, function(response){
					layer.msg(response.msg)
		  })
	    })
	  } else if(layEvent === 'pass') { //编辑
		  layer.confirm('确 定 ?', function(index) {
			var token = "{{ csrf_token() }}"
		      $.post("{{ url('article/pass') }}", {id:data.id , _token:token}, function(response){
						layer.msg(response.msg)
			  })
		    })
	  }
   });
 //表格重载，搜索功能
 $('.reload').click(function(){
	 var author = $("input[name=author]").val();
	 var title = $("input[name=title]").val();
	 var status = $("select[name=status]").val();
	 table.reload('table', {
		  where: { 
			  author: author
		    ,title: title
		    ,status:status
		  }
		  ,method:'post'
	     ,url: '/api/getArticlesList'
	});
 })
  
});
</script>
