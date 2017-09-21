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
            'user_id' => $user_info->id,
            'code'    => $code,
            'email'   => $user_info->email,
        ];
        $this->activeEmail->store($data);
       return true;
    }
    
    /**
     * 
     * @description:激活邮箱确认
     * @author wuyanwen(2017年9月21日)
     * @param@param unknown $type //扩展，其他类型的邮件发送
     * @param@param unknown $code
     * @param@param unknown $email
     */
    public function avtive($type, $code, $user_id)
    {
        return $this->confirm($code, $user_id) ? true : false;
    }
    
    /**
     * 
     * @description:邮箱确认
     * @author wuyanwen(2017年9月21日)
     * @param@param unknown $code
     * @param@param unknown $email
     */
    protected function confirm($code, $user_id)
    {
        $active_info = $this->activeEmail->getRecordByEmail($user_id);
        
        if (!$active_info) return false;
        
        $current_time = time();
        if (strtotime($active_info->created_at) < ($current_time + 24 * 3600)) {
            $active_info->expired = 2;
            $active_info->save();
            return false;
        }
        
        return $active_info->code == $code ? true : false;
    }
}
