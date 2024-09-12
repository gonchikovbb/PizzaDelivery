<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->resource->first_name,
            'middle_name' => $this->resource->middle_name,
            'email' => $this->resource->email,
            'phone_number' => $this->resource->phone_number,
            'birthdate' => $this->resource->birthdate,
            'role_id' => $this->resource->role_id,
        ];
    }
}
