<?php

namespace App\Http\Requests\Traits;


use App\Models\BaseModel;
use Illuminate\Support\Arr;

trait Update
{
    // protected $allowModifyFields = [];

    public function getAllowModifyFields()
    {
        return $this->allowModifyFields;
    }

    public function performUpdate(BaseModel $model, callable $callback = null)
    {
        if (!isset($this->allowModifyFields)) {
            $allowedFields = $this->all();
        }else{
            $allowedFields = Arr::only($this->all(), $this->allowModifyFields);
        }

        if (!is_null($callback)) {
            $allowedFields = $callback($allowedFields);
        }

        if(!empty($allowedFields)) {
            $model->fill($allowedFields)->saveOrFail();
        }

    }
}
