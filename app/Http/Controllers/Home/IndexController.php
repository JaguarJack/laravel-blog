<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repository\ArticleRepository;
use App\Mail\Notice;
use App\Http\Requests\Request;
use Mail;
use Socialite;

class IndexController extends Controller 
{
    /**
     * @description:博客首页
     * @author wuyanwen(2017年9月13日)
     * @param ArticleRepository $article
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request, ArticleRepository $article)
    {
        return view('home.index.index');
    }

    public function importComment()
    {
        
        
        
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
        $reuslt = (\DB::connection('mysql_old')->select('select * from comment'));
        //dd($reuslt);
        $mysql_old = \DB::connection('mysql');
        
        foreach ($reuslt as $vo) {
            $sql = sprintf('insert into comments (`id`,`user_id`,`user_name`,`avatar`
                
            ,`aid`,`content`,`created_at`)
                
value (%d,%d,"%s","%s",%d,"%s","%s")',
                $vo->id, $vo->uid, $vo->comment_user_name, $vo->avatar,$vo->aid,$vo->comment,
                date('Y-m-d H:i:s', $vo->create_time)
                );
            $mysql_old->insert($sql);
            
        }
    }
}
