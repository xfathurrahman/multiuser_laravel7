<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'=> 'max:191',
            'middle_name'=> 'max:191',
            'last_name'=> 'max:191',
            'address'=> 'required|max:200',
            'mobile' => 'required|numeric',
            'country_id'=> 'required|integer',
            'state_id'=> 'required|integer',
            'city' => 'string|max:100',
            'profile_image'=> 'mimes:jpg,jpeg,png',
            'gender' => 'required|string|max:15',
            'hobbies' => 'max:100',
        ];
    }
}
