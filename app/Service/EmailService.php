<?php

namespace App\Service;

use App\Mail\Notice;
use App\Repository\UsersRepository;
use App\Repository\ActiveEamilRepository;
use Mail;

class EmailService
{
    protected $user;
    protected $activeEmail;
    
    public function __construct(ActiveEamilRepository $activeEmail, UsersRepository $user)
    {
        $this->user = $user;
        $this->activeEmail = $activeEmail;
        
    }
    
    /**
     * @description:发送邮件
     * @author wuyanwen(2017年9月21日)
     */
    public function sendEmail($request)
    {
        $user = $request->user();
        $user_info = $this->user->find('id', $request->user('home')->id);
        
        $code = substr(encrypt(str_random(10)), 0, 40);
        $message = [
            'message'   => '注册邮箱激活',
            'user_name' => $user_info->user_name,
            'url'       => url('confirm',['type' => 'activate', 'code' => $code]),
        ];
        //邮件发送
        Mail::to($user)->send(new Notice($message));
        
        $data = [
            'code'  => $code,
            'email' => $user_info->email,
        ];
        $this->activeEmail->store($data);
       return true;
    }
}
