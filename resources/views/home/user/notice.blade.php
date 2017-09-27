@extends('layouts.userEdit')
@section('title','消息通知')
@section('content')
<div class="form">
	<div class="title">消息通知</div>
	@if ($notice->count())
    	<ul class="layui-timeline">
    	@foreach ($notice as $vo)
          <li class="layui-timeline-item" >
            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
            <div class="layui-timeline-content layui-text" @if ($vo->is_read == 2) style="opacity:0.5;"@endif>
              <h3 class="layui-timeline-title">{{ $vo->from_user_name }} </h3>
              <p>
              	 @if ($vo->type == 1)
               	  	 在文章 <a href="javascript:;">{{ $vo->title }}</a> 评论了
               	 @else
               	   	发布新文章  <a href="javascript:;">{{ $vo->title }}</a>
               	 @endif
                @if ($vo->is_read == 1)
                <a href="{{ url('detail',['id' => $vo->aid]) }}.html#reply{{ $vo->aid }}">
                    <span onclick='read("{{ $vo->id }}")'>
                    	点击查看
                    </span>
                </a>
                @else
                 <span class="delete" data="{{ $vo->id }}">
                	已查看/删除
                 </span>
                @endif
              </p>
            </div>
          </li>
      @endforeach
      <li class="layui-timeline-item">
        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
        <div class="layui-timeline-content layui-text">
          <div class="layui-timeline-title">
          	只有这么多了~
          </div>
        </div>
      </li> 
    </ul>
  @else
  		<div style="text-align: center;margin-top: 100px;opacity: 0.5;font-size: 16px;">没有消息通知~空空如也~</div>
  @endif
</div>
<script src="{{ asset('/assets/layui/layui.js') }}"></script>
<script>
layui.use(['element','jquery'], function(){
  var element = layui.element
  			$ = layui.jquery;

   $('.delete').click(function(){
		var id = $(this).attr('data');
		$.post('/deleteNotice', {id,id}, function(response) {
			if (response.status == 10000) {
				$('.delete').parents('.layui-timeline-item').remove()
			}
		})
	})

});

function read(id) {
	$.post('/readNotice',{id,id},function(){})
}
</script>
@endsection