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
    public function sendEmail($user)
    {
        $user_info = $this->user->find('id', $user->id);
        
        //如果还有用户还有未确认邮件
        if ($this->activeEmail->getRecordByEmail($user_info->id)) {
            return false;
        }
        
        $code = substr(encrypt(str_random(10)), 0, 40);
        //邮箱发送信息
        $message = [
            'title'     => '注册邮箱激活',
            'user_name' => $user_info->user_name,
            'url'       => url('confirm',['type' => 'activate', 'code' => $code]),
        ];
        
        //邮件发送
        Mail::to($user_info)->send(new Notice($message));
        
        //添加激活记录
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
    public function avtive($user_id, $code, $type)
    {
        if ($this->confirm($code, $user_id)) {
            //更新用户的激活状态
            $result = $this->user->update([
                        'id'         => $user_id,
                        'activation' => 2,
                       ]);
            
            return $result ? true : false;
        }
            
        return  false;
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
        
        //不存在的验证信息
        if (!$active_info) return false;
        //验证过期
        if (!$active_info->expired) return false;
        //验证超过二十四小时
        if ((strtotime($active_info->created_at) + 24 * 3600) < time()) {
            $active_info->expired = 2;
            $active_info->save();
            return false;
        }
        
        //确认校验码的正确性
        if ($active_info->code == $code) {
            $active_info->expired = 2;
            $active_info->save();
            return true;
        }
        
        return false;
    }
}
