<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Repository\ArticleRepository;
use App\Repository\LikeRepository;
use App\Repository\AttendRepository;
use App\Repository\StoreRepository;
use App\Repository\CommentRepository;

class CategoryController extends Controller
{
    protected $article;
    protected $request;
    
    public function __construct(Request $request, ArticleRepository $article)
    {
        $this->article = $article;
        $this->request = $request;
    }
    
    /**
     * @description:分类页面
     * @author wuyanwen(2017年9月14日)
     */
    public function index()
    {
        return view('home.category.index');
    }
    
    /**
     * @description:文章详情
     * @author wuyanwen(2017年9月14日)
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function detail($id,LikeRepository $like, AttendRepository $attend, StoreRepository $store)
    {
        $article_info = $this->article->find(intval($id));
       
        $user_id = $this->request->user('home') ? $this->request->user('home')->id : 0;
        //dd($attend->isAttended($user_id, $article_info->user_id));
        return view('home.category.detail',[
            'article_info' => $article_info,
            'preNext'      => $this->article->getPreAndNext($id),
            'comments'     => $this->article->getComments($id),
            'liked'        => $like->isLiked($user_id, $id),
            'stored'       => $store->isStored($user_id, $id),
            'attented'     => $attend->isAttended($user_id, $article_info->user_id),
            'user_id'      => $user_id,
        ]);
    }
    
    /**
     * 
     * @description:评论
     * @author wuyanwen(2017年9月17日)
     * @param
     */
    public function comment(Request $request, CommentRepository $comment)
    {
        if (!$request->user('home')) {
            $this->ajaxError('请先登录');
        }
        
        $content = trim($request->input('content'));
        if (!$content) {
            $this->ajaxError('请输入评论内容');
        }
        
        $aid     = $request->input('aid');
        $reply_user = $request->input('reply_user');
        $content= preg_replace('/^(@.*)\s+(.*)/', '<a href="/user/'.$reply_user.'">&nbsp;&nbsp;&nbsp;${1}</a>${2}', $content);

        $user = $request->user('home');
        //dd($user);
        if( $comment->store([
            'user_id'   => $user->id,
            'user_name' => $user->user_name,
            'aid'       => $aid,
            'avatar'    => $user->avatar,
            'content'   => $content,
        ])) {
            return $this->ajaxSuccess('评论成功');
        }
        
    }
}
