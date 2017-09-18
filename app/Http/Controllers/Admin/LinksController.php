<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Request;
use App\Repository\LinksRepository;

class LinksController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.links.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       return view('admin.links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request$request, LinksRepository $links)
    {
        //
        return $links->store($request->all()) ? $this->ajaxSuccess('添加成功') :
        
                            $this->ajaxError('添加失败');
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
    public function edit($id, LinksRepository $links)
    {
        //
        $link_info = $links->find('id', $id);
        
        return view('admin.links.edit',[
            'link_info' => $link_info,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, LinksRepository $links)
    {
        //
        
        return $links->update($request->all()) ? $this->ajaxSuccess('更新成功')
        
                                : $this->ajaxError('更新失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, LinksRepository $links)
    {
        //
        
        return $links->delete($id) ? $this->ajaxSuccess('删除成功')
        
                            : $this->ajaxError('删除失败');
    }
}
