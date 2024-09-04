<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'user_id' => $this->resource->user_id,
            'phone_number' => $this->resource->phone_number,
            'email' => $this->resource->email,
            'address_id' => $this->resource->address_id,
            'delivery_time' => $this->resource->delivery_time,
            'status' => $this->resource->status,
        ];
    }
}
