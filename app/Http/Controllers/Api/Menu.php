<?php

namespace App\Http\Controllers\Api;

use App\Repository\FrontMenuRepository;

class Menu
{
    protected $fmenu;
    
    protected $menu;
    public function __construct(FrontMenuRepository $fmenu)
    {
        $this->fmenu = $fmenu;
    }
    /**
     * @description:获取前台menu
     * @author wuyanwen(2017年9月7日)
     */
    public function getFmeun()
    {
        
    }
    
    /**
     * @description:获取后台menu
     * @author wuyanwen(2017年9月7日)
     */
    public function getMenu()
    {
        
    }
}