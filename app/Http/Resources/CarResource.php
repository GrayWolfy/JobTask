<?php

namespace App\Http\Resources;

use App\Models\Car;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /** @var Car $resource */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'user_id' => $this->resource->user_id,
            'name' => $this->resource->name,
            'auto_number' => $this->resource->auto_number,
            'rented' => $this->resource->rented,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
