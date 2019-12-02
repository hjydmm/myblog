<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StoreAdminRequest extends Request
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
            'username'  => [
                'required',
                Rule::unique('admin')->ignore(isset($data['id']) ? $data['id'] : null),
                'min:2','max:10'
            ],
            'email' => [
                'required',
                Rule::unique('admin')->ignore(isset($data['id']) ? $data['id'] : null),
                'email',
            ],
            'password' => 'required|min:6|max:20|alpha_dash' . isset($data['id']) ? '|sometimes' : '',

        ];
    }
    
}
