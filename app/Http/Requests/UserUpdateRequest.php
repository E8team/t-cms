<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\Update;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends Request
{
    use Update;

    protected $allowModifyFields = ['user_name', 'nick_name', 'email', 'password', 'is_locked', 'avatar'];

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
        $user = $this->route()->parameter('user');
        return [
            'user_name' => [Rule::unique('users')->ignore($user->id)],
            'nick_name' => 'nullable|string',
            'email' => ['email', Rule::unique('users')->ignore($user->id)],
            'avatar' => 'nullable|picture_id',
            'password' => 'nullable|min:6',
            'is_locked' => 'nullable|boolean',
            'role_ids' => 'nullable|int_array'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
