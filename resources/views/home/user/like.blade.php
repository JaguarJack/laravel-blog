@extends('layouts.user')
@section('title','首页')
@section('keywords', '首页')
@section('description', '首页')
@section('content')
<div class="user-nav">
	<a href="{{ url('user/center') }}"> 个人中心 </a>  <span style="opacity:0.5;">\ 个人喜欢</span>
</div>
<div class="share">
	<div class="title">个人喜欢</div>
	<ul class="layui-timeline">
  <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
    <div class="layui-timeline-content layui-text">
      <h3 class="layui-timeline-title">8月18日</h3>
      <p>
        layui 2.0 的一切准备工作似乎都已到位。发布之弦，一触即发。
        <br>不枉近百个日日夜夜与之为伴。因小而大，因弱而强。
        <br>无论它能走多远，抑或如何支撑？至少我曾倾注全心，无怨无悔 <i class="layui-icon"></i>
      </p>
    </div>
  </li>
  <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
    <div class="layui-timeline-content layui-text">
      <h3 class="layui-timeline-title">8月16日</h3>
      <p>杜甫的思想核心是儒家的仁政思想，他有“<em>致君尧舜上，再使风俗淳</em>”的宏伟抱负。个人最爱的名篇有：</p>
      <ul>
        <li>《登高》</li>
        <li>《茅屋为秋风所破歌》</li>
      </ul>
    </div>
  </li>
  <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
    <div class="layui-timeline-content layui-text">
      <h3 class="layui-timeline-title">8月15日</h3>
      <p>
        中国人民抗日战争胜利72周年
        <br>常常在想，尽管对这个国家有这样那样的抱怨，但我们的确生在了最好的时代
        <br>铭记、感恩
        <br>所有为中华民族浴血奋战的英雄将士
        <br>永垂不朽
      </p>
    </div>
  </li>
  <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
    <div class="layui-timeline-content layui-text">
      <div class="layui-timeline-title">过去</div>
    </div>
  </li>
</ul>
	<a href="javascript:;">
	<div class="btn"><i class="fa fa-pencil"></i> 分享所思所闻</div>
	</a>
</div>
@endsection