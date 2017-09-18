@extends('layouts.userEdit')
@section('title','首页')
@section('keywords', '首页')
@section('description', '首页')
@section('content')
<div class="form">
	<div class="title">头像修改</div>
	<div class="layui-upload" style="width:80%;margin:0 auto;padding-bottom:20px;">
      <div class="layui-upload-list">
        <img class="layui-upload-img" src="https://dn-phphub.qbox.me/uploads/avatars/3848_1477641871.png?imageView2/1/w/100/h/100" id="avatar" style="width:300px;height:300px;">
      </div>

      <button type="button" class="layui-btn layui-btn-danger" id="btn"><i class="layui-icon"></i>上传预览图片</button>
      <button class="layui-btn" id="upload">点击上传图片</button>
    </div> 
</div>
<script src="{{ asset('/assets/layui/layui.js') }}"></script>
<script>
layui.use(['element','jquery','upload'], function(){
  var element = layui.element
  			$ = layui.jquery
  	  upload  = layui.upload;
	
  upload.render({
	  elem: '#btn'
	  ,url: '/api/upload/'
	  ,method:'post'
	  ,auto: false //选择文件后不自动上传
	  ,bindAction: '#upload' //指向一个按钮触发上传
	  ,accept:'images'
	  ,exts:'jpg|png|gif|bmp|jpeg'
	  ,size:500
	  ,choose: function(obj){
	    //将每次选择的文件追加到文件队列
	    var files = obj.pushFile();
	    
	    //预读本地文件，如果是多文件，则会遍历。(不支持ie8/9)
	    obj.preview(function(index, file, result){
	      console.log(index); //得到文件索引
	      console.log(file); //得到文件对象
	      console.log(result); //得到文件base64编码，比如图片
	      $('.layui-upload-img').attr('src', result);
	      //这里还可以做一些 append 文件列表 DOM 的操作
	      
	      //obj.upload(index, file); //对上传失败的单个文件重新上传，一般在某个事件中使用
	      //delete files[index]; //删除列表中对应的文件，一般在某个事件中使用
	    });
	  }
  	,done: function(res){
        //如果上传失败
        if(res.code > 0){
          return layer.msg('上传失败');
        }
        //上传成功
      }
	});      

});
</script>
@endsection