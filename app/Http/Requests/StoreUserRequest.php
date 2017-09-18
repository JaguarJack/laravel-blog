<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StoreUserRequest extends Request
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
                Rule::unique('admin_users')->ignore(isset($data['id']) ? $this->all()['id'] : null),
                'min:2','max:10'
            ],
            'email' => [
                'required',
                Rule::unique('admin_users')->ignore(isset($data['id']) ? $this->all()['id'] : null),
                'email',
            ],
            'password' => 'required|min:6|max:20|alpha_dash' . isset($data['id']) ? '|sometimes' : '',

        ];
    }
    
}
