<?php
namespace App\Http\Controllers\Admin\Api;


use App\Entities\Role;

class RolesController extends ApiController
{
    public function lists()
    {
        $roles = Role::withSimpleSearch()
            ->withSort()
            ->ordered()
            ->recent()
            ->paginate($this->perPage());
        return $this->response->paginator($roles, new RoleTransformer())
            ->addMeta('allow_sort_fields', User::$allowSortFields)
            ->addMeta('allow_search_fields', User::$allowSearchFields);
    }
}
