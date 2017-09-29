@extends('layouts.admin')
@section('title', '编辑菜单')
@section('menu1', '菜单管理')
@section('menu2', '编辑菜单')
@section('content')
<div class="form">
<form class="layui-form layui-form-pane">
   <div class="layui-form-item">
        <label class="layui-form-label">父级菜单</label>
        <div class="layui-input-inline">
          <select name="fid" lay-verify="required">
            <option value="0">请选择菜单</option>
            @foreach($menus as $_menu)
            <option value="{{ $_menu['id'] }}" @if($menu->fid == $_menu['id']) selected @endif>
            	{{ str_repeat('--', $_menu['level'])}}{{ $_menu['name'] }}
            </option>
            @endforeach
          </select>
        </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">菜单</label>
    <div class="layui-input-inline">
      <input type="text" name="name"  lay-verify="required" value="{{ $menu->name }}"  class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">菜单code</label>
    <div class="layui-input-inline">
      <input type="text" name="code" value="{{ $menu->code }}"  class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">权重</label>
    <div class="layui-input-inline">
      <input type="text" name="weight" lay-verify="number" value="{{ $menu->weight }}"  class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn layui-btn-big layui-btn-normal" lay-submit lay-filter="edit">更新</button>
    </div>
  </div>
  {{ method_field('PUT') }}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="id" value="{{ $menu->id }}">
</form>
</div>
<script src="{{ asset('/assets/layui/layui.js') }}"></script>
<script>
layui.use('form', function(){
  var form = layui.form
  	  $    = layui.jquery;

  form.on('submit(edit)', function(data){
	 var url = "{{ route('fmenu.update',[$menu->id]) }}"
	 $.post(url, data.field, function(response){
		 if (response.status == 1000) {
			 layer.msg(response.msg, function(){

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

