基于Laravel5.5社交博客 (version 1.0)
---------------------
博客地址：<a href="https://www.njphper.com" target="_blank">njphper blog</a>

### 博客宗旨:分享学习

### 安装下载:git clone https://github.com/yanwenwu/laravel-blog.git

### 基础的框架配置已经好了，需要的就是迁移一下数据库:
* 修改根目录下的.env.bak为.env  
* 找到/app/Service/BuildMenuService; 注释掉construct里面的自动获取分类的方法  
* 迁移文件，首先配置好你的数据库，然后运行命令php artisan migrate --path=/database/migrations/blog即可  
* 进入后台，关闭你的middileware,在routes/web.php，后台路由 中间件auth认证，进入后台后，请自行添加后台用户;  

### 已开发功能: 
* 基本页面展示  
* 用户可自行发表文章(首先必须激活邮箱)  
* 收藏评论点赞  
* 用户一系列操作的展示  
* 用户基本的修改功能  
* 后台基础管理

### 博客功能安排
* 地址库：限制注册,恶意用户直接禁止访问(完成)  
* `问答功能(国庆后)`
* `手册学习功能(国庆后)`


