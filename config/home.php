<?php

return [
    'version' => '1.0',
    
    /*
     * 限制评论发送
     */
    'comment' => [
        'limit'      => true,
        'limit_time' => 60,
    ],
    
    /* 图片限制 */
    'image'   => [
        'type' => ['jpg', 'png', 'gif', 'jpeg'],
        'size' => 500,
    ],
    //站点网址
    'website'    => 'https://www.njphper.com/',
    //后台
    'admindomain' => 'admin.blog.com',
    //前台
    'homeadomain' => 'blog.com',
    //网站基本信息
    'site'        => [
        'title'       => 'NJphper Blog',
        'keywords'    => '分享,社交,博客,编程,学习,问答',
        'description' => '专注分享,分享学习成果,step by step!',
    ],
];