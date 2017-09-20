<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Controllers\Controller;
use App\Repository\UsersRepository;
use App\Service\UsersService;
use App\Repository\ArticleRepository;
use App\Http\Requests\StoreUserInfoRequest;
use App\Repository\CommentRepository;
use App\Repository\StoreRepository;
use App\Repository\AttendRepository;
use App\Repository\LikeRepository;

class UserController extends Controller
{
    //
    protected $request ;
    protected $user;
    
    public function __construct(Request $request, UsersRepository $user)
    {
        $this->request = $request;
        $this->user    = $user;
    }
    
    /**
     * 
     * @description:个人中心
     * @author wuyanwen(2017年9月19日)
     * @param@param unknown $id
     * @param@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index($id, CommentRepository $comment)
    {
        return view('home.user.index',[
            'articles' => $this->user->getArticles(intval($id)),
            'user'     => $this->user->find('id', intval($id)),
            'comments' => $comment->getComments(intval($id)),
            'id'       => $id,
        ]);
    }
    
    /**
     * 
     * @description:分享文章的页面
     * @author wuyanwen(2017年9月19日)
     * @param@param unknown $id
     * @param@param ArticleRepository $article
     * @param@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function share($id, ArticleRepository $article)
    {
        $total = $article->getTotalAritcle($id);
        
        return view('home.user.share',[
                'id' => $id,
            'pages'  => $total['pages'],
            'total'  => $total['total'],
        ]);
    }
    
    /**
     * 
     * @description:用户评论
     * @author wuyanwen(2017年9月19日)
     * @param@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function comment($id, CommentRepository $comment)
    {   
        $total = $comment->getTotalUserComments($id);
        
        return view('home.user.comment',[
            'id'     => $id,
            'pages'  => $total['pages'],
            'total'  => $total['total'],
        ]);
    }
    
    /**
     * 
     * @description:用户喜欢文章页面
     * @author wuyanwen(2017年9月19日)
     * @param@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function like($id, LikeRepository $like)
    {
        return view('home.user.like',[
            'id' => $id,
            'total' => $like->getTotalLike($id),
        ]);
    }
    
    /**
     * 
     * @description:用户关注列表
     * @author wuyanwen(2017年9月19日)
     * @param@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function attend($id, AttendRepository $attend)
    {
        return view('home.user.attend',[
            'id'    => $id,
            'total' => $attend->getTotalAttendUser($id),
        ]);
    }
    
    /**
     * 
     * @description:用户收藏页面
     * @author wuyanwen(2017年9月19日)
     * @param@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store($id, StoreRepository $store)
    {
        return view('home.user.store',[
            'id'    => $id,
            'total' => $store->getTotalStore($id),
        ]);
    }
    
    /**
     * 
     * @description:用户个人编辑页面
     * @author wuyanwen(2017年9月19日)
     * @param@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(Request $request, UsersRepository $user)
    {
        return view('home.user.edit',[
            'user' => $user->find('id', $request->user('home')->id)
        ]);
    }
    
    /**
     * 
     * @description:更新用户信息
     * @author wuyanwen(2017年9月19日)
     * @param
     */
    public function updateUserInfo(StoreUserInfoRequest $request, UsersService $user)
    {
        return $user->updateInfo($request) ? $this->ajaxSuccess('更新成功') : $this->ajaxError('更新失败，请刷新后重新提交');
    }
    /**
     * 
     * @description:密码重置
     * @author wuyanwen(2017年9月19日)
     * @param@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function setPassword(Request $request)
    {
        return view('home.user.setPassword',[
            'email' => $request->user('home')->email,
        ]);
    }
    
    /**
     * 
     * @description:头像设置
     * @author wuyanwen(2017年9月19日)
     * @param@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function setAvatar(Request $request)
    {
        return view('home.user.setAvatar',[
            'avatar' => $request->user('home')->avatar,
        ]);
    }
    
    /**
     * 
     * @description:消息通知
     * @author wuyanwen(2017年9月19日)
     * @param@param UsersRepository $users
     * @param@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function notice(UsersRepository $users)
    {
        return view('home.user.notice',[   
            'notice' => $users->getUserNotice($this->request->user('home')->id),
        ]);
    }
    
    /**
     * 
     * @description:激活页面
     * @author wuyanwen(2017年9月19日)
     * @param@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function activation(Request $request)
    {
        $user = $request->user('home');

        return view('home.user.activation',[
            'activation' => $user->activation,
            'email'      => $user->email,
        ]);
    }
    
    /**
     * 
     * @description:写作页面
     * @author wuyanwen(2017年9月19日)
     * @param@param UsersService $userService
     * @param@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function write(UsersService $userService)
    {
        return view('home.user.write',[
            'category' => $userService->getCategory(),
        ]);
    }
    
    /**
     * 
     * @description:发布文章
     * @author wuyanwen(2017年9月19日)
     * @param@param StoreArticleRequest $request
     * @param@param UsersService $userService
     * @param@return \Illuminate\Http\JsonResponse
     */
    public function publish(StoreArticleRequest $request, UsersService $userService)
    {
        return $userService->publish($request) ? $this->ajaxSuccess('发布成功') : $this->ajaxError('发布失败,请检查~');
        
    }
   
}
