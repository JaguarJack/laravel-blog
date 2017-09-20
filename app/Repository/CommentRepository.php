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
    
    /**
     * @description:获取评论
     * @author wuyanwen(2017年9月20日)
     */
    public function getComments($user_id, $limit = 5, $offset = 0)
    {
        return self::$comment::where('comments.user_id', '=', $user_id)
                                ->leftjoin('articles', 'comments.aid', '=', 'articles.id')
                                ->select('articles.id as aid','articles.title','comments.id','comments.content','comments.created_at')
                                ->orderBy('comments.created_at', 'DESC')
                                ->offset($offset * $limit)
                                ->limit($limit)
                                ->get();
    }
    
    /**
     * @description:获取用户总数
     * @author wuyanwen(2017年9月20日)
     * @param unknown $id
     */
    public function getTotalUserComments($user_id, $limit = 0)
    {
        $total = self::$comment::where('user_id', '=', $user_id)->count();
        
        return ['pages' => ceil($total / ($limit ? : self::$comment::LIMIT)), 'total' => $total];
    }
}
