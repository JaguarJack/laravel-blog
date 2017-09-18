<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Repository\NoticeRepository;

class NoticeController extends Controller
{
    //
    
    /**
     * 
     * @description:更新成已读消息
     * @author wuyanwen(2017年9月18日)
     * @param@param Request $request
     * @param@param NoticeRepository $notice
     * @param@return boolean
     */
    public function readNotice(Request $request, NoticeRepository $notice)
    {
        $id = $request->input('id');
        
        if ( !$id ) {
            return false;
        }

        return $notice->updateReaded($id) ? [] : [];
    }
    
    /**
     * 
     * @description:删除通知
     * @author wuyanwen(2017年9月18日)
     * @param@param Request $request
     * @param@param NoticeRepository $notice
     */
    public function deleteNotice(Request $request, NoticeRepository $notice)
    {
        $id = $request->input('id');
        
        if ( !$id ) {
            return [];
        }
        
        return $notice->delete($id) ? $this->ajaxSuccess('删除成功') : $this->ajaxError('删除失败');
    }
}
