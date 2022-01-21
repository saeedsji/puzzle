<?php

namespace App\Http\Resources\v1;

use App\Models\Category;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($item)
        {
            $subs = Category::active()->where('parent_id', $item->id)->sort()->get();
            return [
                'id' => $item->id,
                'name' => $item->name,
                'image' => $item->image,
                'sub' => new CategoryCollection($subs),
            ];
        });
    }
    
}
