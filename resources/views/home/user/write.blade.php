@extends('layouts.main')
@section('title','首页')
@section('keywords', '首页')
@section('description', '首页')
@section('main')
<link rel="stylesheet" href="{{ asset('/assets/markdown/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('/assets/markdown/css/editormd.css') }}" />    
<script src="{{ asset('/assets/markdown/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/markdown/js/editormd.js') }}"></script>
<div style="width:74%;min-height:500px;background:#fff;margin:10px auto;">
<div id="layout">
            <!--  <header>
                <h1>完整示例</h1>
                <p>Full example</p>
                <ul style="margin: 10px 0 0 18px;">
                    <li>Enable HTML tags decode</li>
                    <li>Enable TeX, Flowchart, Sequence Diagram, Emoji, FontAwesome, Task lists</li>
                    <li>Enable Image upload</li>
                    <li>Enable [TOCM], Search Replace, Code fold</li>
                </ul>            
            </header>
            <div class="btns">
                <button id="goto-line-btn">Goto line 90</button>
                <button id="show-btn">Show editor</button>
                <button id="hide-btn">Hide editor</button>
                <button id="get-md-btn">Get Markdown</button>
                <button id="get-html-btn">Get HTML</button>
                <button id="watch-btn">Watch</button>
                <button id="unwatch-btn">Unwatch</button>
                <button id="preview-btn">Preview HTML (Press Shift + ESC cancel)</button>
                <button id="fullscreen-btn">Fullscreen (Press ESC cancel)</button>
                <button id="show-toolbar-btn">Show toolbar</button>
                <button id="close-toolbar-btn">Hide toolbar</button>
                <button id="toc-menu-btn">ToC Dropdown menu</button>
                <button id="toc-default-btn">ToC default</button>
            </div>-->
        <form class="layui-form">
          <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
              <input type="text" name="title"  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-block">
              <select name="category" lay-verify="required">
                <option value="">请选择</option>
                @foreach ($category as $v)
                	<option value="{{ $v->id }}">{{ $v->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">简介</label>
                <div class="layui-input-block">
                  <textarea name="intro" lay-verify="required"  placeholder="请文章简介" class="layui-textarea"></textarea>
                </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block" style="width:100%;">
              <div id="content"></div>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
              <input type="radio" name="status" value="1" title="草稿" checked>
              <input type="radio" name="status" value="2" title="审核">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">标签</label>
            <div class="layui-input-block"   style="width:50%;">
                 <input type="text" name="tags" lay-verify="required" placeholder="请输入标签  以逗号分隔" autocomplete="off" class="layui-input">
            </div>
          </div>
          {{ csrf_field() }}
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
                    //theme : "dark",
                   // previewTheme : "white",
                   // editorTheme : "pastel-on-dark",
                    //markdown : md,
                    codeFold : true,
                    //syncScrolling : false,
                    saveHTMLToTextarea : true,    // 保存 HTML 到 Textarea
                    searchReplace : true,
                    //watch : false,                // 关闭实时预览
                    htmlDecode : "style,script,iframe|on*",            // 开启 HTML 标签解析，为了安全性，默认不开启    
                    //toolbar  : false,             //关闭工具栏
                    //previewCodeHighlight : false, // 关闭预览 HTML 的代码块高亮，默认开启
                    //emoji : true,
                    taskList : true,
                    tocm  : true,         		  // Using [TOCM]
                    tex : true,                   // 开启科学公式TeX语言支持，默认关闭
                    flowChart : true,             // 开启流程图支持，默认关闭
                    sequenceDiagram : true,       // 开启时序/序列图支持，默认关闭,
                    //dialogLockScreen : false,   // 设置弹出层对话框不锁屏，全局通用，默认为true
                    //dialogShowMask : false,     // 设置弹出层对话框显示透明遮罩层，全局通用，默认为true
                    //dialogDraggable : false,    // 设置弹出层对话框不可拖动，全局通用，默认为true
                    //dialogMaskOpacity : 0.4,    // 设置透明遮罩层的透明度，全局通用，默认值为0.1
                    //dialogMaskBgColor : "#000", // 设置透明遮罩层的背景颜色，全局通用，默认为#fff
                    //imageUpload : true,
                    //imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                    //imageUploadURL : "{{ url('upload')}}",
                    onload : function() {
                        console.log('onload', this);
                        //this.fullscreen();
                        //this.unwatch();
                        //this.watch().fullscreen();
                        this.setMarkdown("#PHP");
                        //this.width("100%");
                        //this.height(480);
                        //this.resize("100%", 640);
                    }
                });
               
                
                $("#goto-line-btn").bind("click", function(){
                    testEditor.gotoLine(90);
                });
                
                $("#show-btn").bind('click', function(){
                    testEditor.show();
                });
                
                $("#hide-btn").bind('click', function(){
                    testEditor.hide();
                });
                
                $("#get-md-btn").bind('click', function(){
                    alert(testEditor.getMarkdown());
                });
                
                $("#get-html-btn").bind('click', function() {
                    alert(testEditor.getHTML());
                });                
                
                $("#watch-btn").bind('click', function() {
                    testEditor.watch();
                });                 
                
                $("#unwatch-btn").bind('click', function() {
                    testEditor.unwatch();
                });              
                
                $("#preview-btn").bind('click', function() {
                    testEditor.previewing();
                });
                
                $("#fullscreen-btn").bind('click', function() {
                    testEditor.fullscreen();
                });
                
                $("#show-toolbar-btn").bind('click', function() {
                    testEditor.showToolbar();
                });
                
                $("#close-toolbar-btn").bind('click', function() {
                    testEditor.hideToolbar();
                });
                
                $("#toc-menu-btn").click(function(){
                    testEditor.config({
                        tocDropdown   : true,
                        tocTitle      : "目录 Table of Contents",
                    });
                });
                
                $("#toc-default-btn").click(function() {
                    testEditor.config("tocDropdown", false);
                });
            });

            layui.use('form', function(){
          	  var form = layui.form;

          	  form.render();
          	  //监听提交
          	  form.on('submit(publish)', function(data){
              	$.post('/publish',data.field,function(response){
						if (response.status == 10001) {
							layer.msg(response.msg);
					    } else{
						}
                })
          	    
          	    return false;
          	  });
          	});
        </script>
@endsection