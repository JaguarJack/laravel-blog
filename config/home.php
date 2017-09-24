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
    
    'site' => 'https://www.njphper.com/',
    'admindomain' => 'blog.com',
];