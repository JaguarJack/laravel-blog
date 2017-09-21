<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repository\ArticleRepository;
use App\Mail\Notice;
use App\Http\Requests\Request;
use Mail;

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
       // $user = $request->user('home');
        
        //dd($user);
       // $data = [
            //'message' => '注册邮箱激活',
            //'user_name' => $user->user_name,
            //'url'       => 'http:www.njphper.com',
       // ];
        
        //Mail::to($user)->send(new Notice($data));die;

        return view('home.index.index');
    }
    
    
    public function importUser()
    {
        $reuslt = (\DB::connection('mysql_old')->select('select * from old_user'));
        
        $mysql_old = \DB::connection('mysql');
        
        foreach ($reuslt as $vo) {
            if ($vo->type) {
                $sql = sprintf('insert into users (
                                id,account, open_id,user_name,
                                password,email,real_name,remember_token,
                                avatar,github_name,github_homepage,sina_name,
                                sina_homepage,come_from,personal_website,introduction,
                                signature,type,gender,activation,
                                online,status) value (
                                        %d,"%s","%s","%s",
                                "%s","%s","%s","%s",
                                "%s","%s","%s","%s",
                                "%s","%s","%s","%s","%s",
                                %d,%d,%d,%d,%d
              )',$vo->id,!$vo->type ? $vo->open_id : '', $vo->type ? $vo->open_id : '',
                    
                    $vo->uname, !$vo->type ? bcrypt('123456') : '',$vo->email,
                    
                    '', '',
                    $vo->head_img,'','','','','地球村',
                    '','','',$vo->type,$vo->sex,$vo->activation,$vo->online,$vo->status);
                    
                    echo $mysql_old->insert($sql);
            }
        }
    }
    
    public function importCate()
    {
        
        $reuslt = (\DB::connection('mysql_old')->select('select * from cate'));
       
        $mysql_old = \DB::connection('mysql');
        
        foreach ($reuslt as $vo) {
            $sql = sprintf('insert into category (`id`,`fid`,`name`,`code`) value (%d,%d,"%s","%s")',
                $vo->id, $vo->fid, $vo->cname, $vo->code
                );
            $mysql_old->insert($sql);
            
        }
    }
    
    
    public function importTag()
    {
        $reuslt = (\DB::connection('mysql_old')->select('select * from tags'));
        
        $mysql_old = \DB::connection('mysql');
        
        foreach ($reuslt as $vo) {
            $sql = sprintf('insert into tags (`id`,`name`,`created_at`) value (%d,"%s","%s")',
                $vo->id, $vo->tagname, date('Y-m-d H:i:s')
                );
            $mysql_old->insert($sql);
        }
    }
    
    public function links()
    {
        $reuslt = (\DB::connection('mysql_old')->select('select * from friendly_link'));
        
        $mysql_old = \DB::connection('mysql');
        
        foreach ($reuslt as $vo) {
            
            $sql = sprintf('insert into links (`id`,`title`,`url`,`show`,`weight`,`created_at`)
                
            value (%d,"%s","%s",%d,%d,"%s")',
                $vo->id, $vo->friendly_name,$vo->friendly_link,1,1, date('Y-m-d H:i:s')
                );
            $mysql_old->insert($sql);
        }
    }
    
    
    public function imposrtAticleRelate()
    {
        $reuslt = (\DB::connection('mysql_old')->select('select * from article_option'));
        
        $mysql_old = \DB::connection('mysql');
        
        foreach ($reuslt as $vo) {
            //dd((\DB::connection('mysql_old')->select('select * from article where id = '. $vo->aid)));
            // $article = (\DB::connection('mysql_old')->select('select * from article where id = '. $vo->aid))[0];
            $sql = sprintf('insert into article_relate (
        `id`,`aid`,`user_id`,`like_number`,`store_number`,`comment_number`,
        `pv_number`,`created_at`
        )
                
            value (%d,%d,%d,%d,%d,%d,%d,"%s")',
                $vo->id,$vo->aid, $vo->uid,$vo->like_num,$vo->enshirne_num,$vo->comment_num,
                
                100,
                date('Y-m-d H:i:s')
                );
            $mysql_old->insert($sql);
        }
        
    }
    public function importArcle()
    {
        $reuslt = (\DB::connection('mysql_old')->select('select * from article'));
        
        $mysql_old = \DB::connection('mysql');
        
        foreach ($reuslt as $vo) {
            $cate = (\DB::connection('mysql_old')->select('select * from cate where id = '. $vo->cid))[0];
            $author = (\DB::connection('mysql_old')->select('select * from old_user where id = '. $vo->uid))[0]->uname;
            $intro = mb_substr(strip_tags($vo->content), 0,200);
            $sql = sprintf('insert into articles (
        `id`,`cid`,`fid`,`user_id`,`author`,`category`,
        `title`,`thumb_img`,`intro`,`content`,`tags`,`status`,`created_at`
        )
                
            value (%d,%d,%d,%d,"%s","%s","%s","%s","%s","%s","%s",%d,"%s")',
                $vo->id,$vo->cid, $cate->fid,$vo->uid,
                $author,$cate->cname,$vo->title,$vo->thumb_img,$intro,$vo->content,
                
                $vo->tagstr,$vo->article_status,date('Y-m-d H:i:s', $vo->create_time)
                );
            $mysql_old->insert($sql);
        }
    }
    
    
    public function updateIntro()
    {
        $mysql_old = \DB::connection('mysql');
        $reuslt = $mysql_old->select('select * from articles');
        
        
        foreach ($reuslt as $vo) {
            $intro = mb_substr(strip_tags(stripslashes(html_entity_decode($vo->content))), 0,200,'utf-8');
            
            //dd((\DB::connection('mysql_old')->select('select * from article where id = '. $vo->aid)));
            // $article = (\DB::connection('mysql_old')->select('select * from article where id = '. $vo->aid))[0];
            $sql = sprintf('update articles set `intro` = "%s" where id = %d',
                $intro,$vo->id
                );
            $mysql_old->update($sql);
        }
    }
    
    public function importComment()
    {
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
