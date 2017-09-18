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
    
    public function doLogin(Request $request)
    {
        $this->login($request);
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
    {   //dd();
        return url()->previous();
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

