@extends('layouts.main')
@section('main')
    <div class=@yield("class")>
        @yield('carousel')
        <div class="main-left" >
        	@yield('content')
        	@yield('page')
        </div>
        <div class="main-right">
        	<div class="tab">
              <div class="title">热门推荐</div>
              <div class="layui-tab-content" style="height: 100px;background-color:white;">
                <div class="layui-tab-item layui-show">1</div>
              </div>
            </div>
            <div class="tab">
              <div class="title">技术站点</div>
              <div class="layui-tab-content" style="height: 100px;background-color:white;">
                <div class="layui-tab-item layui-show">1</div>
              </div>
            </div>
            <div class="tab">
              <div class="title">标签列表</div>
              <div class="layui-tab-content" style="height: 100px;background-color:white;">
                <div class="layui-tab-item layui-show">1</div>
              </div>
            </div>
            <div class="tab">
              <div class="title">友情链接</div>
              <div class="layui-tab-content" style="height: 100px;background-color:white;">
                <div class="layui-tab-item layui-show">1</div>
              </div>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
@endsection