<?php

namespace App\Http\Resources\v1;

use App\Enums\AdvertiseStatus;
use App\Enums\AdvertiseType;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class AdvertiseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'region_id' => $this->region_id,
            'title' => $this->title,
            'type' => $this->type,
            'typeName' => AdvertiseType::get($this->type),
            'status' => $this->status,
            'statusName' => AdvertiseStatus::get($this->status),
            'statusColor' => AdvertiseStatus::color($this->status),
            'view' => $this->view,
            'category_id' => $this->category_id,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'description' => $this->description,
            'image' => $this->imageUrl(),
            'images' => new ImageCollection($this->images),
            'created_at' => Jalalian::forge($this->created_at)->ago(),
        ];
    }
}
