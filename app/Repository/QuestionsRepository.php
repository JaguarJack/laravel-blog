<?php

namespace App\Repository;

use App\Model\Questions;

class QuestionsRepository
{
    //
    protected static $questions;
    
    public function __construct(Questions $questions)
	{
        self::$questions = $questions;
    }
    
    /**
     * @description:根据ID查找记录
     * @author wuyanwen(2017年10月16日)
     * @param unknown $id
     */
    public function findById($id)
    {
        return self::$questions::find($id);
    }
    
    /**
     * @description:获取分页
     * @author wuyanwen(2017年10月16日)
     * @param number $offset
     * @param number $limit
     */
    public function getQuestions($offset = 0, $limit = 0)
    {        
        return self::$article->select('title', 'id', 'pv', 'status', 'answer_number', 'created_at')
                             ->offset($offset * ($limit ? : self::$article::LIMIT))
                             ->limit($limit ? : self::$article::LIMIT)
                             ->orderBy('articles.id', 'DESC')
                             ->get();
    }
    
    /**
     * @description:增加PV数目
     * @author wuyanwen(2017年10月16日)
     * @param unknown $id
     */
    public function IncPv($id)
    {
        return self::$questions::where('id', '=', $id)->increment('pv');
    }
    
    /**
     * @description:增加回答数
     * @author wuyanwen(2017年10月16日)
     * @param unknown $id
     */
    public function incAnswerNumber($id)
    {
        return self::$questions::where('id', '=', $id)->increment('answer_number');
    }
    
    /**
     * @description:结贴
     * @author wuyanwen(2017年10月16日)
     */
    public function setStatus($id)
    {
        $question = $this->findById($id);
        
        $question->status = 2;
        
        return $question->update();
    }
    
    /**
     * @description:获取问答总数
     * @author wuyanwen(2017年10月16日)
     */
    public function getTotalQuestions()
    {
        return self::$questions->count();
    }
    
    /**
     * @description:提交问答
     * @author wuyanwen(2017年10月16日)
     * @param unknown $question_data
     */
    public function add($question_data)
    {
        return self::$questions::create($question_data);
    }
}
