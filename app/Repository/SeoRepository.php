<?php

namespace App\Repository;

use App\Model\Seo;

class SeoRepository
{
    //
    protected static $seo;
	public function __construct(Seo $seo)
	{
	    self::$seo = $seo;
	}
	
	
	/**
	 * 
	 * @description:查询一条信息
	 * @author wuyanwen(2017年9月10日)
	 * @param@param unknown $id
	 */
	public function find($key, $value)
	{
        return self::$seo::where($key, $value)->first();
	}
	
	/**
	 * 
	 * @description:更新seo信息
	 * @author wuyanwen(2017年9月10日)
	 * @param@param unknown $data
	 */
	public function update($data)
	{
	    $info = $this->find('id', $data['id']);
	    
	    $info->title = $data['title'];
	    $info->keywords = $data['keywords'];
	    $info->description = $data['description'];
	    
	    return $info->save();
	}
	
	/**
	 * 
	 * @description:添加一条记录
	 * @author wuyanwen(2017年9月10日)
	 * @param@param unknown $data
	 */
	public function store($data)
	{
	    return self::$seo::create([
	        'cid'   => $data['cid'],
	        'title' => $data['title'],
	        'keywords' => $data['keywords'],
	        'description' => $data['description'],
	    ]);
	}
}
