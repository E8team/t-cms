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
            ->setMeta(Role::getAllowSortFieldsMeta() + Role::getAllowSortFieldsMeta());
    }

    public function store(RoleCreateRequest $request)
    {
        Role::create($request->all());
        return $this->response->noContent();
    }

    public function update(Role $role, RoleUpdateRequest $request)
    {
        $request->performUpdate($role);
        return $this->response->noContent();
    }

    public function destroy($id)
    {
        if (!Role::destroy(intval($id))) {
            //todo 国际化
            throw new NotFoundHttpException('该角色不存在');
        }
        return $this->response->noContent();
    }
}
