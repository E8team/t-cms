<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\Update;
use Illuminate\Validation\Rule;


class UserUpdateRequest extends Request
{

    use Update;

    protected $allowModifyFields = ['user_name', 'nick_name', 'email', 'password', 'is_lock'];
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
        $userId = $this->route()->parameter('user');
        return [
            'user_name' => ['required', Rule::unique('users')->ignore($userId)],
            'nick_name' => 'string',
            'email' => ['email', Rule::unique('users')->ignore($userId)],
            'avatar' => 'string|max:40',
            'password' => 'min:6',
            'is_lock' => 'boolean'
        ];
    }
}
