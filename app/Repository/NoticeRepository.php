<?php

namespace App\Repository;

use App\Model\Notice;

class NoticeRepository
{
    //
    protected static $notice;
    
    public function __construct(Notice $notice)
	{
        self::$notice = $notice;
    }
    
    /**
     * 
     * @description:存储一条消息
     * @author wuyanwen(2017年9月18日)
     * @param
     */
    public function store($data)
    {
        return self::$notice::create($data);
    }
    
    /**
     * 
     * @description:获取用户未读信息
     * @author wuyanwen(2017年9月18日)
     * @param@param unknown $user_id
     */
    public function getNotRead($user_id)
    {
        $where = [
            ['user_id', '=', $user_id],
            ['is_read', '=', self::$notice::NOTREAD]
        ];
        
        return self::$notice::where($where)->count();
    }
    
    /**
     * 
     * @description:更新程已读状态
     * @author wuyanwen(2017年9月18日)
     * @param
     */
    public function updateReaded($id)
    {
        $notice = self::$notice->find($id);
        
        if ($notice->is_read == self::$notice::READED) return false;
        
        $notice->is_read = self::$notice::READED;
        
        return $notice->save();
    }
    
    /**
     * 
     * @description:删除
     * @author wuyanwen(2017年9月18日)
     * @param@param unknown $id
     * @param@return unknown
     */
    public function delete($id)
    {
        $notice = self::$notice->find($id);
 
        return $notice->delete();
    }
    
    /**
     * @description:获取通知
     * @author wuyanwen(2017年9月27日)
     * @param unknown $user_id
     * @return unknown
     */
    public function getNotice($user_id)
    {
        return self::$notice::where('notice.user_id', '=', $user_id)
                            ->leftjoin('articles', 'articles.id', '=', 'notice.aid')
                            ->select('articles.title', 'notice.*')
                            ->orderBy('notice.created_at')
                            ->get();
    }
}
