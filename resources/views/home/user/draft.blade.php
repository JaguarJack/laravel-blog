@extends('layouts.main')
@section('title','分享写作')
@section('main')
<link rel="stylesheet" href="{{ asset('/assets/markdown/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('/assets/markdown/css/editormd.css') }}" />    
<script src="{{ asset('/assets/markdown/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/markdown/js/editormd.js') }}"></script>
<div style="width:74%;min-height:500px;background:#fff;margin:10px auto;">
<style>
    .editormd-code-toolbar select {display:inline-block;}
</style>
<div id="layout">
        <form class="layui-form">
          <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
              <input type="text" name="title"  value="{{ $draft->title }}" lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-block">
              <select name="category" lay-verify="required">
                <option value="">请选择</option>
                @foreach ($category as $v)
                	@if (!$v->code)
                		<option value="{{ $v->id }}" @if($draft->cid == $v->id ) selected @endif>{{ str_repeat('-', $v->level)}} {{ $v->name }}</option>
                	@endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">简介</label>
                <div class="layui-input-block">
                  <textarea name="intro" lay-verify="required"  placeholder="请文章简介" class="layui-textarea">{{ $draft->intro }}</textarea>
                </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block" style="width:100%;">
              <div id="content">
               <textarea style="display:none;">
               	{!! htmlspecialchars_decode($draft->markdown_content) !!}
               </textarea>
               </div>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
              <input type="radio" name="status" value="1" title="草稿" @if($draft->status ==1) checked @endif>
              <input type="radio" name="status" value="2" title="审核" @if($draft->status ==2) checked @endif>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">标签</label>
            <div class="layui-input-block"   style="width:50%;">
                 <input type="text" name="tags" lay-verify="required" value="{{$draft->tags}}" autocomplete="off" class="layui-input">
            </div>
          </div>
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $draft->id }}">
          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit lay-filter="publish">发布文章</button>
            </div>
          </div>
        </form>          
	</div>
</div>
<script type="text/javascript">
            var testEditor;           
            $(function() {
                testEditor = editormd("content", {
                    width: "90%",
                    height: 740,
                    path : "/assets/markdown/lib/",
                    codeFold : true,
                    saveHTMLToTextarea : true,    // 保存 HTML 到 Textarea
                    searchReplace : true,
                    htmlDecode : "style,script,iframe|on*",// 开启 HTML 标签解析，为了安全性，默认不开启    
                    taskList : true,
                    tocm  : true,         		  // Using [TOCM]
                    tex : true,                   // 开启科学公式TeX语言支持，默认关闭
                    flowChart : true,             // 开启流程图支持，默认关闭
                    sequenceDiagram : true,       // 开启时序/序列图支持，默认关闭,
                    onload : function() {
                        console.log('onload', this);
                    }
                });
            });

            layui.use('form', function(){
          	  var form = layui.form;
          	  form.render();
          	  //监听提交
          	  form.on('submit(publish)', function(data){
              	$.post('/publish',data.field,function(response){
						if (response.status == 10001) {
							layer.msg(response.msg, {icon: 5}); 
					    } else{
					    	layer.msg(response.msg, {icon: 6},function(){
								window.location.href= "{{ route('user.share',[ $user->id ]) }}"
						    }); 
						}
                })
          	    
          	    return false;
          	  });
          	});
        </script>
@endsection