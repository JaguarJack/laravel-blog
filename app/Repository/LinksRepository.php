<?php

namespace App\Repository;

use App\Model\Links;

class LinksRepository
{
    //
    protected static $links;
    
    public function __construct(Links $links)
    {
        self::$links = $links;
    }
    /**
     *
     * @author:wuyanwen
     * @description:创建用户
     * @date:2017年9月2日
     * @param array $data
     * @return unknown
     */
    public function store(array $data)
    {
        return self::$links::create([
            'title'  => $data['title'],
            'url'    => $data['url'],
            'show'   => $data['show'],
            'weight' => $data['weight'],
        ]);
        
    }
    
    /**
     *
     * @author:wuyanwen
     * @description:用户分页
     * @date:2017年9月3日
     * @param unknown $page
     */
    public function page($offset=0, $limit = 15, $where = [])
    {
        $data = self::$links::where($where)
                        ->select('id','title','url','show','weight','created_at')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
        
        $total = self::$links::where($where)->count();
        
        return ['data' => $data, 'total' => $total];
    }
    
    /**
     *
     * @author:wuyanwen
     * @description:查找记录
     * @date:2017年9月3日
     */
    public function find($field, $value)
    {
        return self::$links::where($field, $value)->first();
    }
    
    /**
     * @description:删除一条记录
     * @author wuyanwen(2017年9月5日)
     * @param unknown $id
     * @return unknown
     */
    public function delete($id)
    {
        return self::$links::destroy($id);
    }
    
    /**
     * @description:
     * @author wuyanwen(2017年9月6日)
     */
    public function update($data)
    {
        $links = self::$links::find($data['id']);
        
        $links->title   = $data['title'];
        $links->show    = $data['show'];
        $links->url     = $data['url'];
        $links->weight  = $data['weight'];
        
        return $links->save();
    }
    
}
