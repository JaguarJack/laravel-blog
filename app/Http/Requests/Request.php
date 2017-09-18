<?php

namespace App\Http\Requests;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    /**
     * 
     * @author:wuyanwen
     * @description:重写错误返回g
     * @date:2017年9月3日
     * @param Validator $validator
     * @return number[]|unknown[]
     */
    protected function failedValidation(Validator $validator)
    {
        
        $message = $validator->errors()->all();

        $response = response()->json([
            'status' => 10001,
            'msg'    => $message[0],
            'data'   => [],
        ]);
        
        throw new ValidationException($validator, $response);
    }
    
    public function rules()
    {
        return [];
    }
}