@extends('layouts.user')
@section('title','首页')
@section('keywords', '首页')
@section('description', '首页')
@section('content')
<div class="user-nav">
	<a href="{{ url('user/center') }}"> 个人中心 </a>  <span style="opacity:0.5;">\ 个人关注</span>
</div>
<div class="write">
	<div class="title">个人关注</div>
	<div>
		<ul>
			<li>
    			<span><img src="https://dn-phphub.qbox.me/uploads/avatars/1_1479342408.png?imageView2/1/w/100/h/100"  style="width:30px;height:30px;"></span>&nbsp;&nbsp;
    			<a href="javascript:;">JaguarJack</a>&nbsp;&nbsp;--
    			<span class="info"><a href="javascript:;">难道这就是第一个我关注的人吗?</span>
    		</li>
    	</ul>
		<div class="no-article" style="display:none;">空空如也~</div>
	</div>
</div>
@endsection