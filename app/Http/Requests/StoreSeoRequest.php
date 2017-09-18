<?php

namespace App\Http\Requests;

class StoreSeoRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:6|max:100',
            'keywords' => 'sometimes|min:6|max:255',
            'description' => 'sometimes|min:10|max:255',
        ];
    }
}
