<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreSeoRequest;
use App\Repository\SeoRepository;

class SeoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeoRequest $request, SeoRepository $seo)
    {
        //
        return $seo->store($request->all()) ? $this->ajaxSuccess('添加成功') 
            
                                : $this->ajaxError('添加失败');
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
    public function edit($id, SeoRepository $seo)
    {
        //
        $seo_info = $seo->find('cid', $id);

        return view('admin.seo.edit',[
            'seo_info' => $seo_info,
            'cid'      => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSeoRequest $request, $id, SeoRepository $seo)
    {
        //
        return $seo->update($request->all()) ? $this->ajaxSuccess('更新成功')
        
                                        : $this->ajaxError('更新失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
