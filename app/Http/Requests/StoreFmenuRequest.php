<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StoreFmenuRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $data = $this->all('id');
        return [
            'name'  => [
                'required',
                Rule::unique('category')->ignore(isset($data['id']) ? $this->all()['id'] : null),
                'min:2','max:10'
            ],
            'code' => [
                'required',
                Rule::unique('category')->ignore(isset($data['id']) ? $this->all()['id'] : null),
                'alpha',
            ],
        ];
    }
}
