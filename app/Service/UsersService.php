<?php

namespace App\Service;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use Illuminate\Support\Facades\DB;
use App\Repository\ArticleRelateRepository;
use App\Repository\NoticeRepository;

class UsersService
{
    protected $type = [
        1 => '注册用户',
        2 => 'QQ用户',
        3 => '微博用户',
        4 => '其他',
    ];
    
    protected $category;
    protected $article;
    protected $comment;
    protected $article_relate;
    protected $notice;
    
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
        ArticleRelateRepository $article_relate,NoticeRepository $notice)
    {
        $this->category = $category;
        $this->article  = $article;
        $this->comment  = $comment;
        $this->article_relate = $article_relate;
        $this->notice   = $notice;
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
        //dd($request->input('tags'));
        $data = [
            'cid'      => $category->id,
            'fid'      => $category->fid,
            'title'    => $request->input('title'),
            'tags'     => strpos('，', $request->input('tgas')) ? str_replace('，', ',', $request->input('tags')) : $request->input('tags'),
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
        $content = trim($request->input('content'));
        
        if (!$content) {
            $this->ajaxError('请输入评论内容');
        }
        
        $aid     = $request->input('aid');
        $reply_user = $request->input('reply_user');
        $content= preg_replace('/^(@.*)\s+(.*)/', '<a href="/user/'.$reply_user.'">${1}</a>&nbsp;&nbsp;${2}', $content);
        
        $user = $request->user('home');
        
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
        
        //事务开始
        DB::beginTransaction();
        if( $this->comment->store($data) 
            && $this->article_relate->incrementCommentNum($aid) 
            && $this->notice->store($messge)) {
            Db::commit();
            return true;
        } else {
            Db::rollback();
            return false;
        }
    }
}
