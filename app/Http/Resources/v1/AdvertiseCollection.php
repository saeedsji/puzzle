<?php

namespace App\Http\Resources\v1;

use App\Enums\AdvertiseStatus;
use App\Enums\AdvertiseType;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Morilog\Jalali\Jalalian;

class AdvertiseCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($item)
        {
            return [
                'id' => $item->id,
                'region_id' => $item->region_id,
                'title' => $item->title,
                'type' => $item->type,
                'typeName' => AdvertiseType::get($item->type),
                'status' => $item->status,
                'statusName' => AdvertiseStatus::get($item->status),
                'statusColor' => AdvertiseStatus::color($item->status),
                'view' => $item->view,
                'image' => $item->imageUrl(),
                'created_at' => Jalalian::forge($item->created_at)->ago(),
            ];
        });
    }
}
