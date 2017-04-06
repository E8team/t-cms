<?php

namespace App\Transformers;

use App\Entities\Link;
use League\Fractal\TransformerAbstract;

class LinkTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['type'];

    public function transform(Link $link)
    {
        return [
            'id' => $link->id,
            'url' => $link->url,
            'logo' => $link->logo,
            'logo_urls' => $link->logo_urls,
            'linkman' => $link->linkman,
            'type_id' => $link->type_id,
            'order' => $link->order,
            'is_visible' => $link->is_visible,
            'created_at' => $link->created_at->toDateTimeString(),
            'updated_at' => $link->updated_at->toDateTimeString()
        ];
    }

    public function includeType(Link $link)
    {
        $type = $link->type;
        return $this->item($type, new TypeTransformer());
    }
}
