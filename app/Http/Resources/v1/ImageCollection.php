<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ImageCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($item)
        {
            return [
                'id' => $item->id,
                'url' => $item->url,
                'main' => $item->main,
            ];
        });
    }
}
