<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repository\UsersRepository;

class RegisterController extends Controller
{
    //
    use RegistersUsers;
    
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/signin';
    protected $user;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UsersRepository $user)
    {
        $this->middleware('guest');
        $this->user = $user;
    }
    
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function doRegister(Request $request)
    {
        return $this->register($request);
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:15',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|max:100',
        ], $this->messages());
    }
    
    private function messages()
    {
        return [
            'name.required' => '请填写昵称',
            'name.string'   => '昵称必须为字符串',
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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return $this->user->store($data);   
    }
}
