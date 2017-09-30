<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class IndexController extends Controller 
{
    /**
     * @description:博客首页
     * @author wuyanwen(2017年9月13日)
     * @param ArticleRepository $article
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('home.index.index');
    }
    
    public function test()
    {
        $this->importComment();
    }
    public function importComment()
    {
        
        $users = (\DB::connection('mysql_old')->select('select * from user'));
        //dd($reuslt);
        $_users = \DB::connection('mysql')->select('select * from users');
        
        foreach ($_users as $vo) {
            foreach ($users as $user) {

                if ($user->open_id == $vo->open_id) {
                    $sql = sprintf('update users set `type` = "%d" where id = %d',$user->type + 1, $vo->id);
                    
                    \DB::connection('mysql')->update($sql);
                }
            }
        }
        die;
        $results = $mysql_old->select('select * from articles');
        
        foreach ($results as $vo) {
            
            
            if ($vo->id > 80) {
                $avatar = str_replace('img','images', $vo->thumb_img);
                $intro = mb_substr(str_replace('&nbsp;','',strip_tags(html_entity_decode($vo->content))),0,200,'utf8');
                $intro = str_replace('"','',$intro);
                $sql = sprintf('update `articles` set `intro`="%s",`thumb_img`="%s" where id = %d',$intro, $avatar,$vo->id);
                echo $mysql_old->update($sql);
            }
            
        }
        die;
        
    }
}
