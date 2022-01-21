<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'phone' => $this->phone,
            'name' => $this->name,
            'email' => $this->email,
            'lastLogin' => Jalalian::forge($this->lastLogin)->ago(),
            'created_at' => Jalalian::forge($this->created_at)->ago(),
        ];
    }
}
