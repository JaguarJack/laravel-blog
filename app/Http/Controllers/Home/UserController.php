<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Repository\UsersRepository;
use App\Repository\ArticleRepository;

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
    
    public function index($id)
    {dd($this->user->getArticles(intval($id)));
        if (!$id) {
           
        }
        return view('home.user.index',[
            'articles' => $this->user->getArticles(intval($id)),
        ]);
    }
    
    public function share()
    {
        return view('home.user.share');
    }
    
    public function comment()
    {
        return view('home.user.comment');
    }
    
    public function like()
    {
        return view('home.user.like');
    }
    
    public function attend()
    {
        return view('home.user.attend');
    }
    
    public function store()
    {
        return view('home.user.store');
    }
    
    public function edit()
    {
        return view('home.user.edit');
    }
    
    public function setPassword()
    {
        return view('home.user.setPassword');
    }
    
    public function setAvatar()
    {
        return view('home.user.setAvatar');
    }
    
    public function notice()
    {
        return view('home.user.notice');
    }
    
    public function activation()
    {
        return view('home.user.activation');
    }
    
    
    public function write(Request $request, ArticleRepository $article)
    {
        if ($request->method() == 'POST') {
            $user = $request->user('home');
            
            $data = [
                'content' => $request->input('content'),
                'user_id' => $user->user_id,
                'name'  => $user->user_name,
            ];
            $article->store($data);
        } else {
            return view('home.user.write');
        }
       
    }
    
    
    
   
}
