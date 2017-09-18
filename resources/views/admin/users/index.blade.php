@extends('layouts.admin')
@section('title','用户管理')
@section('menu1', '用户管理')
@section('content')
<blockquote class="layui-elem-quote">
<form class="layui-form">
    <div class="layui-input-inline">
      <input type="text" name="name" placeholder="请输入用户名" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-input-inline">
      <input type="text" name="email" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-input-inline">
      <select name="type">
        <option value="0">请选择用户类型</option>
        @foreach ($type as $key => $vo)
        	<option value="{{ $key }}">{{ $vo }}</option>
        @endforeach
      </select>
    </div>

    <button class="layui-btn reload" onclick="return false;"><i class="layui-icon">&#xe615;</i>搜素</button>
	<button class="layui-btn add"><i class="layui-icon">&#xe608;</i>添加用户</button>
</form>
</blockquote>
<table class="layui-table" lay-data="{height:315,width:1200, method:'post', url:'/api/getUsers', page:true,limit: 10, id:'table'}" lay-filter="table">
  <thead>
    <tr>
      <th lay-data="{field:'id', align:'center',width:80, sort: true}">ID</th>
      <th lay-data="{field:'name', align:'center',width:100}">用户名</th>
      <th lay-data="{field:'email', align:'center',width:100}">邮箱</th>
      <th lay-data="{field:'avatar', align:'center',width:80}">头像</th>
      <th lay-data="{field:'come_from', align:'center',width:100}">来自</th>
      <th lay-data="{field:'type', align:'center',width:100}">类型</th>
      <th lay-data="{field:'sex', align:'center',width:100}">性别</th>
      <th lay-data="{field:'activation', align:'center',width:100}">激活</th>
      <th lay-data="{field:'status', align:'center',width:100}">状态</th>
      <th lay-data="{field:'created_at', align:'center',width:100}">添加时间</th>
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
	 var email = $("input[name=email]").val();
	 var type = $("select[name=type]").val();
	 
	 table.reload('table', {
		  where: { 
		    name: name
		    ,email: email
		    ,type:type
		  }
		  ,method:'post'
	     ,url: '/api/getUsers'
	});
 })
  
});

</script>
