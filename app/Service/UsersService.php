<?php

namespace App\Service;

class UsersService
{
    public $type = [
        1 => '注册用户',
        2 => 'QQ用户',
        3 => '微博用户',
        4 => '其他',
    ];
    
    /**
     * @description:返回用户类型
     * @author wuyanwen(2017年9月13日)
     * @param unknown $type_id
     * @return string
     */
    public function getReigsterType($type_id)
    {
        return $this->type[$type_id];
    }
}
