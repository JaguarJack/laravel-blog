<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Repository\AttendRepository;

class AttendController extends Controller
{
    //
    
    /**
     * @description:获取关注
     * @author wuyanwen(2017年9月20日)
     * @param Request $request
     */
    public function getAttend(Request $request, AttendRepository $attend)
    {
        $page = intval($request->input('page'));
        
        $user_id = intval($request->input('user_id'));
        
        return $this->ajaxSuccess('', $attend->getAttendUser($user_id, 10, $page - 1)->toArray());
    }
}
