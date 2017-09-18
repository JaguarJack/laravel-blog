<?php

namespace App\Repository;

use App\Model\Category;

class CategoryRepository
{
    //
    protected static $category;
    
    public function __construct(Category $category)
	{
	    self::$category = $category;
    }
    
    /**
     * 
     * @description:获取菜单
     * @author wuyanwen(2017年9月7日)
     * @param
     */
    public function getCates($where = null)
    {
        return self::$category::where($where ? : [])->select('id','fid','name','code')->get();
    }

    /**
     * 
     * @description:创建菜单
     * @author wuyanwen(2017年9月7日)
     * @param
     */
    public function store($data)
    {
        return self::$category::create([
            'fid'   => intval($data['fid']),
            'name'  => $data['name'],
            'code'  => $data['code'],
        ]);    
    
    }
    
    /**
     * 
     * @description:查找一条记录
     * @author wuyanwen(2017年9月7日)
     * @param@param unknown $id
     */
    public function find($field, $value)
    {
        return self::$category::where($field, $value)->first();
    }
    
    /**
     * 
     * @description:更新记录
     * @author wuyanwen(2017年9月7日)
     * @param
     */
    public function update($data)
    {
        $menu = self::$category::find($data['id']);

        $menu->fid   = $data['fid'];
        $menu->name = $data['name'];
        $menu->code  = $data['code'];
        
        return $menu->save();
    }
    
    /**
     * 
     * @description:删除一条记录
     * @author wuyanwen(2017年9月7日)
     * @param@param unknown $id
     */
    public function delete($id)
    {
        return self::$category::destroy([$id]);
    }
}

