@extends('layouts.admin')
@section('title', '页面seo信息')
@section('menu1', '页面管理')
@section('menu2', 'seo信息')
@section('content')
<div class="form">
<form class="layui-form layui-form-pane">
  <div class="layui-form-item">
    <label class="layui-form-label">标题</label>
    <div class="layui-input-block">
      <input type="text" name="title"  lay-verify="required" value="{{ $seo_info->title ?? '' }}"  class="layui-input">
    </div>
  </div>
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">关键词</label>
    <div class="layui-input-block">
      <textarea name="keywords" placeholder="请输入关键词" class="layui-textarea">{{ $seo_info->keywords ?? '' }}</textarea>
    </div>
  </div>
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">描述</label>
    <div class="layui-input-block">
      <textarea name="description" placeholder="请输入描述" class="layui-textarea">{{ $seo_info->description ?? '' }}</textarea>
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn layui-btn-big layui-btn-normal" lay-submit lay-filter="edit">更新</button>
    </div>
  </div>
  @if (isset($seo_info->id)) 
  	{{  method_field('PUT') }}
  @endif
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="id" value="{{ $seo_info->id ?? 0}}">
  <input type="hidden" name="cid" value="{{ $cid }}">
</form>
</div>
<script src="{{ asset('/assets/layui/layui.js') }}"></script>
<script>
layui.use('form', function(){
  var form = layui.form
  	  $    = layui.jquery;

  form.on('submit(edit)', function(data){
	  var url;
	 if (data.field.id == 0) {
	 	 url = '/seo'
	 } else {
		 url = '/seo/' +data.field.id
     }
	 
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

