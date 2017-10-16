<?php

namespace App\Repository;

use App\Model\Answer;

class AnswerRepository
{
    //
    protected static $answer;
    
	public function __construct(Answer $answer)
	{
	    self::$answer = $answer;
	}
	
	
	/**
	 * @description:根据question_id 获取回答
	 * @author wuyanwen(2017年10月16日)
	 * @param unknown $qid
	 */
	public function getAnswersByQid($qid, $offset = 0, $limit = 0)
	{
	    
	    return self::$article::where('qid', '=', $qid)
    	                    ->select('title', 'id', 'pv', 'status', 'answer_number', 'created_at')
                    	    ->offset($offset * ($limit ? : self::$article::LIMIT))
                    	    ->limit($limit ? : self::$article::LIMIT)
                    	    ->orderBy('status', 'DESC')
                    	    ->orderBy('id', 'DESC')
                    	    ->get();
	}
	
	/**
	 * @description:采纳
	 * @author wuyanwen(2017年10月16日)
	 * @param unknown $id
	 */
	public function setStatus($id)
	{
	    $answer = self::$answer::find($id);
	    
	    $answer->status = 2;
	    
	    return $answer->update();
	}
	
	/**
	 * @description:获取问题回答总数
	 * @author wuyanwen(2017年10月16日)
	 * @param unknown $qid
	 */
	public function getTotalAnswers($qid)
	{
	    return self::$answer::where('qid', '=', $qid)->count();
	}
}
