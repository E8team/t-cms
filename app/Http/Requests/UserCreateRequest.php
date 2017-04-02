<?php

namespace App\Http\Requests;


class UserCreateRequest extends Request
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
            'user_name' => 'required|unique:users',
            'nick_name' => 'nullable|string|max:30',
            'email' => 'email|unique:users',
            'avatar' => 'nullable|picture_id',
            'password' => 'required'
        ];
    }
}
