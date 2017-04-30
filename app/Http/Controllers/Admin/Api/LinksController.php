<?php

/**
 * 友情链接
 */

namespace App\Http\Controllers\Admin\Api;


use App\Entities\Link;
use App\Entities\Type;
use App\Http\Requests\LinkCreateRequest;
use App\Http\Requests\LinkUpdateRequest;
use App\Transformers\LinkTransformer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LinksController extends ApiController
{

    public function lists(Type $type = null)
    {
        $links = Link::byType($type)
            ->ordered()
            ->recent()
            ->withSimpleSearch()
            ->withSort()
            ->paginate();
        return $this->response->paginator($links, new LinkTransformer())
            ->setMeta(Link::getAllowSortFieldsMeta() + Link::getAllowSearchFieldsMeta());
    }

    public function show(Link $link)
    {
        return $this->response->item($link, new LinkTransformer());
    }

    public function store(LinkCreateRequest $request)
    {
        $data = $request->all();
        $data = filterNullWhenHasDefaultValue($data, ['order', 'is_visible']);
        Link::create($data);
        return $this->response->noContent();
    }

    public function update(Link $link, LinkUpdateRequest $request)
    {
        $request->performUpdate($link);
        return $this->response->noContent();
    }

    public function destroy(Link $link)
    {
        $link->delete();
        return $this->response->noContent();
    }
}