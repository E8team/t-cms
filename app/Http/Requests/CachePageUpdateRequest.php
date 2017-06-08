<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\Update;
use Illuminate\Validation\Rule;

class CachePageUpdateRequest extends Request
{
    use Update;

    protected $allowModifyFields = ['is_cache_forever', 'cache_time'];

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
            'is_cache_forever' => 'nullable|boolean',
            'cache_time' => 'nullable|int'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
