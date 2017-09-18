@extends('layouts.admin')
@section('title','用户管理')
@section('menu1', '用户管理')
@section('content')
<blockquote class="layui-elem-quote">
    <div class="layui-input-inline">
      <input type="text" name="name" placeholder="请输入用户名" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-input-inline">
      <input type="text" name="email" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
    </div>
    <button class="layui-btn reload"><i class="layui-icon">&#xe615;</i>搜素</button>
	<button class="layui-btn add"><i class="layui-icon">&#xe608;</i>添加用户</button>
</blockquote>
<table class="layui-table" lay-data="{height:315,width:1500, method:'post', url:'/api/userPage', page:true,limit: 10, id:'table'}" lay-filter="table">
  <thead>
    <tr>
      <th lay-data="{field:'id', align:'center',width:80, sort: true}">ID</th>
      <th lay-data="{field:'name', align:'center',width:200}">用户名</th>
      <th lay-data="{field:'email', align:'center',width:300}">邮箱</th>
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
	      $.post('/user/' + data.id,{_method:'DELETE', _token:token}, 
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
	    window.location.href = '/user/' +data.id+ '/edit';
	  }
   });
  $('.add').click(function(){
	window.location.href= "{{ url('user/create') }}";
  })
 
 //表格重载，搜索功能
 $('.reload').click(function(){
	 var name = $("input[name=name]").val();
	 var email = $("input[email=email]").val();	 
	 table.reload('table', {
		  where: { 
		    name: name
		    ,email: email
		  }
		  ,method:'post'
	     ,url: '/api/userPage'
	});
 })
  
});

</script>
