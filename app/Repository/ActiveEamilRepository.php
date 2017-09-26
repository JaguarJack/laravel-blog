<?php

namespace App\Repository;

use App\Model\ActiveEmail;

class ActiveEamilRepository
{
    //
    protected static $activeEmail;
    
    public function __construct(ActiveEmail $activeEmail)
	{
	    self::$activeEmail = $activeEmail;
    }
    
    
    /**
     * @description:增加数据
     * @author wuyanwen(2017年9月21日)
     * @param unknown $data
     */
    public function store($data)
    {
        return self::$activeEmail::create($data);
    }
    
   /**
    * @description:根据$user_id查询记录
    * @author wuyanwen(2017年9月21日)
    * @param unknown $email
    */
    public function getRecordByEmail($user_id)
    {
        $where = [
            ['user_id', '=', $email],
            ['expired', '=', 1],
        ];
        
        return self::$activeEmail::where($where)->first();
    }
}
