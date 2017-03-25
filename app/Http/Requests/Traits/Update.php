<?php

namespace App\Http\Requests\Traits;

use Illuminate\Database\Eloquent\Model;

trait Update
{
    //protected $allowModifyFields = [];

    public function performUpdate(Model $model)
    {
        if(!isset($this->allowModifyFields)){
            $this->allowModifyFields = array_keys($this->rules());
        }
        $allowedFields = array_filter($this->only($this->allowModifyFields));
        $model->fill($allowedFields)->saveOrFail();
    }
}