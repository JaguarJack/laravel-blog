<?php

return [
    
    /*
     * 限制评论发送
     */
    'comment' => [
        'limit'      => true,
        'limit_time' => 60,
    ],
    
    
    'image'   => [
        'type' => ['jpg', 'png', 'gif', 'jpeg'],
        'size' => 500,
    ]
];