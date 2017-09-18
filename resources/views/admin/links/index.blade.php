@extends('layouts.admin')
@section('title','友情链接管理')
@section('menu1', '友情链接管理')
@section('content')
<blockquote class="layui-elem-quote">
    <div class="layui-input-inline">
      <input type="text" name="title" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
    <button class="layui-btn reload"><i class="layui-icon">&#xe615;</i>搜素</button>
	<button class="layui-btn add"><i class="layui-icon">&#xe608;</i>添加友情链接</button>
</blockquote>
<table class="layui-table" lay-data="{height:315,width:1200, method:'post', url:'/api/getlinks', page:true,limit: 10, id:'table'}" lay-filter="table">
  <thead>
    <tr>
      <th lay-data="{field:'id', align:'center',width:80, sort: true}">ID</th>
      <th lay-data="{field:'title', align:'center',width:200}">标题</th>
      <th lay-data="{field:'url', align:'center',width:300}">url</th>
      <th lay-data="{field:'show', align:'center',width:300}">状态</th>
      <th lay-data="{field:'created_at', align:'center',width:300}">添加时间</th>
      <th lay-data="{fixed: 'right', width:400, align:'center', toolbar: '#option'}"></th>
    </tr>
  </thead>
</table>
@endsection
<script src="{{ asset('/assets/layui/layui.js') }}"></script>
<script type="text/html" id="option">
<a class="layui-btn layui-btn-mini" lay-event="edit">编辑</a>
<a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
</script>
<script>
layui.use('table', function(){
  var table = layui.table
  	  form  = layui.form
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
	  if(layEvent === 'del'){ //删除
	    layer.confirm('确认删除吗', function(index){

		var token = "{{ csrf_token() }}"
	      $.post('/links/' + data.id,{_method:'DELETE', _token:token}, 
	    	      function(response){

				if (response.status == 10000) {
					  obj.del(); //删除对应行（tr）的DOM结构
				      layer.close(index);
				} else {
					layer.msg(response.msg)
			    }

		  })
	    })
	  } else if(layEvent === 'edit'){ //编辑
	    window.location.href = '/links/' +data.id+ '/edit';
	  }
   });
  $('.add').click(function(){
	window.location.href= "{{ url('links/create') }}";
  })
 
 //表格重载，搜索功能
 $('.reload').click(function(){
	 var title = $("input[name=title]").val(); 
	 table.reload('table', {
		  where: { 
			  title: title
		  }
		  ,method:'post'
	     ,url: '/api/getlinks'
	});
 })
  
});

</script>
