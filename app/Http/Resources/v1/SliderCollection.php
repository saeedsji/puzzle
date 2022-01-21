<?php

namespace App\Http\Resources\v1;

use App\Course;
use App\Enums\SliderType;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SliderCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($item)
        {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'type' => $item->type,
                'typeName' => SliderType::getKey($item->type),
                'image' => $item->image,
                'advertise' => $item->advertise_id,
                'screen' => $item->screen,
                'link' => $item->link,
            ];
        });
    }
}
