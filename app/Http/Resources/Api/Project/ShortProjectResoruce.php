<?php

namespace App\Http\Resources\Api\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\User\ShortUserResource;
use App\Http\Resources\Api\ProjectAttribute\ProjectAttributeValueResoruce;

class ShortProjectResoruce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status->value,
            'creator_id' => $this->creator_id,
            'creator_name' => $this->creator->full_name,
            'attributes' => $this->attributes ? ProjectAttributeValueResoruce::collection($this->attributes) : __('n/a')
        ];
    }
}
