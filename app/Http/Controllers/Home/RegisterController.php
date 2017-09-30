<?php

namespace App\Http\Controllers\Home;

use Event;
use Auth;
use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repository\UsersRepository;
use App\Events\RegisterIpEvent;
use App\Repository\IpsRepository;

class RegisterController extends Controller
{
    //
    use RegistersUsers;
    
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $user;
    protected $ips;
    protected $request;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UsersRepository $user, IpsRepository $ips, Request $request)
    {
        $this->middleware('guest');
        $this->user = $user;
        $this->ips  = $ips;
        $this->request = $request;
    }
    
    /**
     * @description:注册页面
     * @author wuyanwen(2017年9月13日)
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function signup()
    {
        return view('home.index.register');
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function doRegister()
    {
        return $this->register($this->request);
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|min:2|max:12',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|max:100',
        ], $this->messages());
        
        $validator->after(function ($validator) {
            if (!$this->ipIsRegister()) {
                $validator->errors()->add('name', '一个IP只能注册一次~');
           }
        });
        
        return $validator;
    }
    
    /**
     * @description:是否注册过了
     * @author wuyanwen(2017年9月30日)
     * @param IpsRepository $ips
     * @return string
     */
    protected function ipIsRegister()
    {
        if ($this->ips->findByIp($this->request->ip())) {
            Log::info('ip频繁注册', ['ip' => $this->request->ip(), 'time' => date('Y-m-d H:i:s')]);
            return false;
        }
        
        return true;
    }
    
    /**
     * @description:错误信息
     * @author wuyanwen(2017年9月18日)
     * @return string[]
     */
    private function messages()
    {
        return [
            'name.required' => '请填写昵称',
            'name.string'   => '昵称必须为字符串',
            'name.min'      => '昵称长度必须大于二个字符',
            'name.max'      => '昵称不得超过十五个字符',
            'email.required'=> '邮箱必须填写',
            'email.string'  => '邮箱必须为字符串类型',
            'email.email'   => '邮箱格式不正确',
            'email.max'     => '邮箱长度不得超过一百字符',
            'email.unique'  => '该邮箱已被注册',
            'password.required' => '密码必须填写',
            'password.min'  => '密码最低必须填写六位',
            'password.max'  => '超过密码最大长度',
            
        ];
    }
    
    /**
     * @description:跳转地址
     * @author wuyanwen(2017年9月21日)
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function redirectTo()
    {
        return url('user/activation');
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if ($user = $this->user->store($data)) {
            Event::fire(new RegisterIpEvent($this->ips));
            
            return $user;
        }   
    }
    
    
    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('home');
    }
}
