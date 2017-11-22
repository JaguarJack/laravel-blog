<?php

namespace App\Service;

use App\Repository\NoticeRepository;

class NoticeService
{
    protected $notice;
    
    public function __construct(NoticeRepository $notice)
    {
        $this->notice = $notice;
    }
   
    /**

     * 
     * @description:获取未读消息
     * @author wuyanwen(2017年9月18日)
     * @param@param unknown $user_id

     * @description:获取未读消息数量
     * @author wuyanwen(2017年9月19日)
     * @param unknown $user_id
     */
    public function getNotRead($user_id)
    {
        return $this->notice->getNotRead($user_id);
    }
}
