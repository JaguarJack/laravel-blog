@extends('layouts.admin')
@section('title', '添加菜单')
@section('menu1', '菜单管理')
@section('menu2', '添加菜单')
@section('content')
<div class="form">
<form class="layui-form layui-form-pane">
   <div class="layui-form-item">
        <label class="layui-form-label">父级菜单</label>
        <div class="layui-input-inline">
          <select name="fid" lay-verify="required">
            <option value="0">请选择菜单</option>
            @foreach($menus as $menu)
            <option value="{{ $menu['id'] }}">
            	{{ str_repeat('--', $menu['level'])}}{{ $menu['name'] }}
            </option>
            @endforeach
          </select>
        </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">菜单</label>
    <div class="layui-input-inline">
      <input type="text" name="name"  lay-verify="required" placeholder="请输入菜单名"  class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">菜单code</label>
    <div class="layui-input-inline">
      <input type="text" name="code" placeholder="请输入菜单code"  class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">权重</label>
    <div class="layui-input-inline">
      <input type="text" name="weight" lay-verify="number" value='1'  class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn layui-btn-big layui-btn-normal" lay-submit lay-filter="add">添加</button>
    </div>
  </div>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
</div>
<script src="{{ asset('/assets/layui/layui.js') }}"></script>
<script>
layui.use('form', function(){
  var form = layui.form
  	  $    = layui.jquery;

  form.on('submit(add)', function(data){
	 $.post('/fmenu', data.field, function(response){
		 if (response.status == 1000) {
			 layer.msg(response.msg, function(){
				 alert(123)
				 window.location.href = "{{ url('user') }}";
			 });
			 
		 } else {
			 layer.msg(response.msg);
		 }
	 });

	 return false;
  });

})
</script>
@endsection

