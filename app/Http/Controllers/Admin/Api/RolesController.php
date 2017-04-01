<?php
namespace App\Http\Controllers\Admin\Api;


use App\Entities\Role;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Transformers\RoleTransformer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RolesController extends ApiController
{
    public function show(Role $role)
    {
        return $this->response->item($role, new RoleTransformer());
    }

    public function lists()
    {
        $roles = Role::withSimpleSearch()
            ->withSort()
            ->ordered()
            ->paginate($this->perPage());
        return $this->response->paginator($roles, new RoleTransformer())
            ->addMeta('allow_sort_fields', Role::$allowSortFields)
            ->addMeta('allow_search_fields', Role::$allowSearchFields);
    }

    public function store(RoleCreateRequest $request)
    {
        Role::create($request->all());
        return $this->response->noContent();
    }

    public function update($role, RoleUpdateRequest $request)
    {
        $request->performUpdate($role);
        return $this->response->noContent();
    }

    public function destroy($id)
    {
        if (!Role::destroy($id)) {
            //todo 国际化
            throw new NotFoundHttpException('该角色不存在');
        }
        return $this->response->noContent();
    }
}
