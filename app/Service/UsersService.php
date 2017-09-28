<?php

namespace App\Service;

use Cookie;
use Config;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\ArticleRelateRepository;
use App\Repository\NoticeRepository;
use App\Repository\UsersRepository;
use App\Traits\Response;

class UsersService
{
    use Response;
    
    public $type = [
        1 => '注册用户',
        2 => 'QQ用户',
        3 => '微博用户',
        4 => 'github用户',
        5 => '其他',
    ];
    
    protected $category;
    protected $article;
    protected $comment;
    protected $article_relate;
    protected $notice;
    protected $user;
    /**
     * 
     * @description:初始化
     * @author wuyanwen(2017年9月18日)
     * @param@param CategoryRepository $category
     * @param@param ArticleRepository $article
     * @param@param CommentRepository $comment
     */
    public function __construct(CategoryRepository $category, 
        ArticleRepository $article, CommentRepository $comment,
        ArticleRelateRepository $article_relate,NoticeRepository $notice, UsersRepository $user)
    {
        $this->category = $category;
        $this->article  = $article;
        $this->comment  = $comment;
        $this->article_relate = $article_relate;
        $this->notice   = $notice;
        $this->user     = $user;
    }
    
    /**
     * @description:返回用户类型
     * @author wuyanwen(2017年9月13日)
     * @param unknown $type_id
     * @return string
     */
    public function getReigsterType($type_id)
    {
        return $this->type[$type_id];
    }
    
    /**
     * @description:发布文章
     * @author wuyanwen(2017年9月18日)
     * @param CategoryRepository $category
     * @param ArticleRepository $article
     */
    public function publish($request)
    {
        $category = $this->category->find('id', $request->input('category'));

        $user = $request->user('home');
        
        //是否有草稿或者未审核的文章
        if ($this->getNotPassArticles($user)) {
            return '还有草稿或者未审核文章~';
        }
        
        $data = [
            'cid'      => $category->id,
            'fid'      => $category->fid,
            'title'    => $request->input('title'),
            'tags'     => strpos($request->input('tags'), '，') ? str_replace('，', ',', $request->input('tags')) : $request->input('tags'),
            'content'  => $request->input('content'),
            'intro'    => $request->input('intro'),
            'user_id'  => $user->id,
            'author'   => $user->user_name,
            'category' => $category->name,
            'status'   => $request->input('status'),
        ];
        
        return $this->article->store($data);
    }
    
    /**
     * @description:获取分类
     * @author wuyanwen(2017年9月18日)
     */
    public function getCategory()
    {
        return $this->category->getCates([['fid', '<>', 0]]);
    }
    
    /**
     * 
     * @description:用户评论
     * @author wuyanwen(2017年9月18日)
     * @param
     */
    public function comment($request)
    {           
        //获取用户信息
        $user = $request->user('home');
        //默认设置限制评论
        if (Config::get('home.comment.limit') && $this->limitComment($user, $request)) {
            return '评论频次太高，请稍后再试';
        }
       
        $content = trim($request->input('content'));
        if (!$content) {
            return '请输入评论内容';
        }
        
        $aid     = $request->input('aid');
        $reply_user = $request->input('reply_user');
        //匹配@用户
        $link = sprintf('<a href="/user/%d">${1}</a>&nbsp;&nbsp;${2}', $reply_user);
        $content= preg_replace('/^(@.*)\s+(.*)/', $link, $content);
        //评论数据
        $data = [
            'user_id'   => $user->id,
            'user_name' => $user->user_name,
            'aid'       => $aid,
            'avatar'    => $user->avatar,
            'content'   => $content,
        ]; 
        //消息数据
        $messge = [
            'user_id'        => $reply_user ? : $this->article->find($aid)->user_id,
            'from_user_name' => $user->user_name,
            'aid'            => $aid,
        ];

        $comment = $this->comment->store($data);
        $messge['comment_id'] = $comment->id;
        //如果成功返回数据
        if( $this->article_relate->incrementCommentNum($aid) && $this->notice->store($messge)) {
            $data['id'] = $comment->id;
            $data['created_at'] = date('Y-m-d H:i:s');
            return $data;
        } else {
            return '评论失败~';
        }
    }
    
    /**
     * 
     * @description:修改用户信息
     * @author wuyanwen(2017年9月19日)
     * @param@param unknown $request
     */
    public function updateInfo($request)
    {
        $data = $request->all();
        $user = $request->user('home');
        //如果修改了邮箱信息则需要重置激活状态
        if ($data['email'] != $user->email) {
            $data['activation'] = 1;
        }
        $data['id'] = $user->id;
        
        if ($this->user->update($data)) {
            $user->email = $data['email'];
            $user->activation = 1;
            return true;
        }
        
        return false;
    }
    
    /**
     * @description:限制评论发送
     * @author wuyanwen(2017年9月20日)
     */
    public function limitComment($user, $request)
    {
        $key = 'next_comment_time_' . $user->id;
        
        if ($request->hasCookie($key)) {
            if ($request->cookie($key) > time()) {
                return true;
            } else {
                Cookie::queue($key, time() + Config::get('home.comment.limit_time'), 60);
                return false;
            }
        } else{
            Cookie::queue($key, time() + Config::get('home.comment.limit_time'), 60);
        } 
    }
    
    /**
     * 
     * @description:查询用户是否有草稿或者等待审核文章
     * @author wuyanwen(2017年9月24日)
     * @param
     */
    protected function getNotPassArticles($user)
    {
        return  $this->article->getNotPassByUserId($user->id) > 1 ? true : false;
    }
}
