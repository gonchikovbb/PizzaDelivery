<?php

namespace App\Http\Resources\Address;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'title' => $this->resource->title,
            'city' => $this->resource->city,
            'street' => $this->resource->street,
            'building' => $this->resource->building,
            'floor' => $this->resource->floor,
            'room' => $this->resource->room,
        ];
    }
}
