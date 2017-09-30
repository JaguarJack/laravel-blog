<?php

namespace App\Repository;

use App\Model\Ips;

class IpsRepository
{
    //
    protected static $ips;
    
    public function __construct(Ips $ips)
	{
        self::$ips = $ips;
    }
    
    /**
     * @description:添加一条ip记录
     * @author wuyanwen(2017年9月30日)
     * @param unknown $ip
     */
    public function store($ip)
    {
        return self::$ips::create([
            'address' => $ip,
        ]);
    }
    
    /**
     * @description:查询ip是否注册过
     * @author wuyanwen(2017年9月30日)
     * @param unknown $ip
     */
    public function findByIp($ip)
    {
        return self::$ips::where('address', '=', $ip)->first() ? true : false;
    }
}
