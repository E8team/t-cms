<?php

namespace App\Http\Requests\Traits;

use Illuminate\Database\Eloquent\Model;

trait Update
{
    // protected $allowModifyFields = [];

    public function getAllowModifyFields()
    {
        return $this->allowModifyFields;
    }

    public function performUpdate(Model $model, callable $callback = null)
    {
        //todo  allowModifyFields 为空的话可以直接$this->all()
        if (!isset($this->allowModifyFields)) {
            $this->allowModifyFields = array_keys($this->rules());
        }

        //$allowedFields = array_filter($this->only($this->allowModifyFields));
        $allowedFields = array_filter($this->only($this->allowModifyFields), function ($item) {
            return !is_null($item);
        });
        ;
        if (!is_null($callback)) {
            $allowedFields = $callback($allowedFields);
        }
        $model->fill($allowedFields)->saveOrFail();
    }
}
