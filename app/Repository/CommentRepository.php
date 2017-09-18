<?php

namespace App\Repository;

use App\Model\Comment;

class CommentRepository
{
    //
    protected static $comment;
    
    public function __construct(Comment $comment)
	{
        self::$comment = $comment;
    }
    
    /**
     * 
     * @description:添加评论
     * @author wuyanwen(2017年9月17日)
     * @param
     */
    public function store($data)
    {
        return self::$comment::create([
            'user_id'   => $data['user_id'],
            'user_name' => $data['user_name'],
            'avatar'    => $data['avatar'],
            'aid'       => $data['aid'],
            'content'   => $data['content'],
        ]);
    }
}
