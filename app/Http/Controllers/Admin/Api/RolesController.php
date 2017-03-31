<?php
namespace App\Http\Controllers\Admin\Api;


use App\Entities\Role;
use App\Transformers\RoleTransformer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Hash;

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
            ->addMeta('allow_sort_fields', Role::$allowSortFields)
            ->addMeta('allow_search_fields', Role::$allowSearchFields);
    }

    public function store()
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
    }

    public function destroy($id)
    {
        if (!Role::destroy($id)) {
            //todo 国际化
            throw new NotFoundHttpException('该角色不存在');
        }
    }
}
