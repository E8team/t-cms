<?php

/**
 * 友情链接
 */

namespace App\Http\Controllers\Admin\Api;

use App\Models\Link;
use App\Models\Type;
use App\Http\Requests\LinkCreateRequest;
use App\Http\Requests\LinkUpdateRequest;
use App\Transformers\LinkTransformer;

class LinksController extends ApiController
{
    public function allLinks()
    {
        $links = Link::ordered()
            ->ancient()
            ->withSimpleSearch()
            ->withSort()
            ->paginate($this->perPage());
        return $this->response->paginator($links, new LinkTransformer())
            ->setMeta(Link::getAllowSortFieldsMeta() + Link::getAllowSearchFieldsMeta());
    }

    public function lists(Type $type = null)
    {
        $links = Link::byType($type)
            ->ancient()
            ->recent()
            ->withSimpleSearch()
            ->withSort()
            ->paginate($this->perPage());
        return $this->response->paginator($links, new LinkTransformer())
            ->setMeta(Link::getAllowSortFieldsMeta() + Link::getAllowSearchFieldsMeta());
    }

    public function show(Link $link)
    {
        return $this->response->item($link, new LinkTransformer());
    }

    public function store(LinkCreateRequest $request)
    {
        Link::create($request->all());
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
