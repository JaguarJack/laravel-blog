@extends('layouts.admin')
@section('title','菜单管理')
@section('menu1', '菜单管理')
@section('content')
<blockquote class="layui-elem-quote">
	<button class="layui-btn add"><i class="layui-icon">&#xe608;</i>添加菜单</button>
</blockquote>
<div class="layui-form">
  <table class="layui-table">
    <colgroup>
      <col width="150">
      <col width="300">
      <col width="200">
      <col>
    </colgroup>
    <thead>
      <tr>
        <th>菜单id</th>
        <th>菜单名称</th>
        <th>菜单code</th>
        <th>操作</th>
      </tr> 
    </thead>
    <tbody>
    @foreach ($menus as $menu)
      <tr>
        <td>{{ $menu['id'] }}</td>
        <td>
        @if($menu['level'])|
        @endif
        {{ str_repeat('—', $menu['level'])}} {{ $menu['name'] }}
        </td>
        <td>{{ $menu['code'] }}</td>
        <td>
        	<a href="{{ route('fmenu.edit',['id' => $menu['id']]) }}"class="layui-btn layui-btn-mini" lay-event="edit">编辑</a>
			<a data="{{ $menu['id'] }}" class="layui-btn layui-btn-danger layui-btn-mini delete">删除</a>
			<a href="{{ route('seo.edit',['id' => $menu['id']]) }}" class="layui-btn layui-btn-mini layui-btn-warm">页面描述</a>
        </td>
      </tr>
      @endforeach
  </tbody>
</table>  
@endsection
<script src="{{ asset('/assets/layui/layui.js') }}"></script>
<script>
layui.use('table', function(){
  var form  = layui.form
	   $    = layui.jquery;
  
  $('.add').click(function(){
	window.location.href= "{{ url('fmenu/create') }}";
  })

  $('.delete').click(function(){
	  var id = $(this).attr('data');
	  layer.confirm('确认删除吗', function(index){
			var token = "{{ csrf_token() }}"
		      $.post('/fmenu/' + id,{_method:'DELETE', _token:token}, 
		    	   function(response){
					if (response.status == 10000) {
						  window.location.reload();
					} else {
						layer.msg(response.msg)
				    }
			   })
		    })
    })
});

</script>
