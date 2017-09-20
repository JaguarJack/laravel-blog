<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    protected $redirectTo = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('signout');
    }
    
    /**
     * 
     * @description:登录页面
     * @author wuyanwen(2017年9月20日)
     * @param@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function signin()
    {
        return view('home.index.login');
    }
    
    /**
     * 
     * @description:登录
     * @author wuyanwen(2017年9月20日)
     * @param@param Request $request
     * @param@return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function doLogin(Request $request)
    {
        return $this->login($request);
    }
    
    /**
     * 
     * @description:登出
     * @author wuyanwen(2017年9月16日)
     * @param
     */
    public function signout(Request $request)
    {
        $this->guard()->logout();
        
        $request->session()->invalidate();
        
        return redirect('/');
       
    }
    /**
     * 
     * @description:返回上一页
     * @author wuyanwen(2017年9月16日)
     * @param@return unknown
     */
    public function redirectTo()
    {
        return url('user',['id' => $this->guard()->user()->id]);
    }
    
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('home');
    }
}

