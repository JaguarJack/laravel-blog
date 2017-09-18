<?php

namespace App\Http\Requests;

class StoreArticleRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'    => 'required|min:6|max:100',
            'content'  => 'required|min:100',
            'tags'     => 'required|string|max:20',
            'category' => 'required|numeric',    
            'intro'    => 'required|min:10|max:200',
        ];
    }
    
    
    public function messages()
    {
        return [
            'title.required'    => '文章标题必须填写',
            'title.min'         => '文章标题最少要六个字符长度',
            'title.max'         => '文章标题最大不得超过一百个字符',
            'content.required'  => '文章内容必须填写',
            'content.min'       => '文章最少一百个字符长度',
            'tags.required'     => '文章标签必须填写',
            'tags.string'       => '文章标签必须为字符',
            'tags.max'          => '文章标签最大填写20个字符',
            'category.required' => '请选择分类',
            'category.numeric'  => '出错啦3~',
            'intro.required'    => '文章简介必须填写',
            'intro.min'         => '文章简介最少要十个字符长度',
            'intro.max'         => '文章标题最大不得超过二百个字符',
        ];
    }
    
    /**
     * 配置验证器实例。
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->checkTagsNumber()) {
                $validator->errors()->add('tags', '标签数量不能超过两个');
            }
        });
    }
    
    /**
     * @description:验证标签
     * @author wuyanwen(2017年9月18日)
     */
    protected function checkTagsNumber()
    {
        $tags = $this->input('tgas');
        if (strpos(',', $tags)) {
            return count(explode(',', $tags)) > 2 ? true : false;
        }
    }
}
