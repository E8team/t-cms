<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Rule;

class UserUpdateRequest extends FormRequest
{
    protected $allowModifyFields = ['user_name', 'nick_name', 'email', 'password', 'is_lock'];
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->route()->getParameter('userId');
        return [
            'user_name' => ['required', Rule::unique('users')->ignore($userId)],
            'nick_name' => 'string',
            'email' => ['email', Rule::unique('users')->ignore($userId)],
            'password' => 'min:6',
            'is_lock' => 'boolean'
        ];
    }
}
