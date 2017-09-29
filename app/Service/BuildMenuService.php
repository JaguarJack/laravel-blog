<?php

namespace App\Service;

use App\Repository\CategoryRepository;

class BuildMenuService
{
    private $menu;
    
    public function __construct(CategoryRepository $menuRepository)
    {
        $this->menu = $menuRepository->getCates();
    }
    /**
     * 
     * @description:获取树形菜单
     * @author wuyanwen(2017年9月7日)
     * @param@param unknown $menus
     */
    public function treeMenu($fid = 0, $level = 0, &$tree_menu = [])
    {
        foreach ($this->menu as $key => $menu) {
            if ($menu->fid == $fid) {
                $menu->level = $level;                
                $tree_menu[] = $menu;
                $tree_menu = array_merge($tree_menu, $this->treeMenu($menu->id, $level+1));
                unset($this->menu[$key]);
            }
        }
        
        return $tree_menu;
    }
    
    /**
     * @description:顺序菜单
     * @author wuyanwen(2017年9月13日)
     * @param number $fid
     * @param number $level
     * @param array $tree_menu
     */
    public function sortMenu($fid = 0, &$sort_menu = [])
    {
        foreach ($this->menu as $key => $menu) {
            if ($menu->fid == $fid) {
                $sort_menu[$key] = $menu;
                $sort_menu[$key][$menu->id] = $this->sortMenu($menu->id);
                unset($this->menu[$key]);
            }
        }
        
        return $sort_menu;
    }

}
