<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>njphper.com</title>
    <meta name="keywords" content=""  />
    <style>
        .title {margin:0 40px;color:#999;border-bottom:1px dotted #ddd;padding:40px 0 30px;font-size:13px;text-align:center}
        .title a {text-decoration:none;color:#009a61;font-size:18px;}
        .body {margin:80px auto 0;width:580px;background:#fff;border:1px dotted #ddd;box-shadow: 10px 10px 5px #888888;border-radius:5px;text-align:left}
    </style>
</head>
<body>
<div class="body">
    <div class='title' style="">
        <a href="{{ config('home.site') }}" target="_blank">Willing To Share At Njphper</a><br>乐于分享  社区博客</div>
    <div style="padding:30px 40px 40px">
	{{ $user_name }} 您好，请在 24 小时内点击此链接以完成{{ $_message }}
	<a style="color:#009a61;text-decoration:none" href="{{ $_url }}">
    {{ $_url }}
	</a>
	<br>
激活遇到问题？请联系我
 <a href="mailto:njphper@gmail.com" target="_blank">njphper@gmail.com</a>
</div>
<div style="text-align:center;height:100px">
社区源码分享至GITHUB，欢迎STAR
      <a href="https://github.com/yanwenwu/laravel-blog/" target="_blank" class="site-star">
        <div style="width:80px;height:30px;background-color:#009a61;color:white;display:inline-block;line-height:30px;border-radius:5px;">Star</div>
      </a>
</div>
</div>           
</body>
</html>