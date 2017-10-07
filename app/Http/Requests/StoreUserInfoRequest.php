<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StoreUserInfoRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name'       => 'required|min:2|max:15',
            'email'           => [
                                'required',
                                 Rule::unique('users')->ignore($this->user('home')->id),
                                'email',
            ],
            'real_name'       => 'nullable|max:10',
            'gender'          => 'nullable|numeric',
            'github_name'     => 'nullable|max:20',
            'github_homepage' => 'nullable|url',
            'company'         => 'nullable|max:10',
            'sina_name'       => 'nullable|max:20',
            'sina_homepage'   => 'nullable|url',
            'website'         => 'nullable|url',
            'introduction'    => 'nullable|max:100',
            'signature'       => 'nullable|max:255',
        ];
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
     */
    public function messages()
    {
        return [
            'user_name.required'  => '请填写昵称',
            'user_name.min'       => '昵称最少两个字符',
            'user_name.max'       => '昵称最多十五个字符',
            'email.required'      => '请填写邮箱',
            'email.unique'        => '邮箱已被注册，请填写其他邮箱',
            'email.email'         => '不支持该邮箱格式',
            'real_name.max'       => '真实姓名长度不超过十个字符',
            'gender.max'          => '性别选择错误',
            'github_name.max'     => 'github name 最大不超过二十个字符',
            'github_homepage.url' => '请填写正确地址格式',
            'company.max'         => '公司名称最大不超过五十个字符',
            'sina_name.max'       => '新浪微博昵称不得超过二十个字符',
            'sina_homepage.url'   => '请填写正确的微博地址',
            'website.url'         => '请填写正确的个人网站地址',
            'introduction.max'    => '个人简介不得超过一百个字符',
            'signature.max'       => '个人署名不得超过二百五十个字符',
        ];
    }
}
