<?php

namespace App\Http\Controllers\Admin;

use App\Service\BuildMenuService;
use App\Http\Requests\StoreFmenuRequest;
use App\Repository\CategoryRepository;

class FrontMenuController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BuildMenuService $menuService)
    {    
        $menus = $menuService->treeMenu();
        
        return view('admin.frontmenu.index',[
            'menus' => $menus,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(BuildMenuService $menuService)
    {
        //
        $menus = $menuService->treeMenu();
        
        return view('admin.frontmenu.create',[
            'menus' => $menus,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFmenuRequest $request,CategoryRepository $menu)
    {
        //
        
        return $menu->store($request->all()) ? $this->ajaxSuccess('创建成功')
                            
                                : $this->ajaxError('创建失败');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, CategoryRepository $menu, BuildMenuService $menuService)
    {
        //
        $menu = $menu->find('id', $id);
        $menus = $menuService->treeMenu();

        return view('admin.frontmenu.edit',[
            'menu' => $menu,
            'menus' => $menus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFmenuRequest $request, $id, CategoryRepository $menu)
    {
        return $menu->update($request->all()) ? $this->ajaxSuccess('修改成功')
        
                                : $this->ajaxError('修改失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, CategoryRepository $menu)
    {
        //是否有子菜单
        if ($menu->find('fid', $id)) {
            return $this->ajaxError('请先删除菜单的子菜单');
        }
        
        return $menu->delete($id) ? $this->ajaxSuccess('删除成功')
        
                                 : $this->ajaxError('删除失败');
    }

}
