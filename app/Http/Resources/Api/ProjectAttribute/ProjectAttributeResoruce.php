<?php

namespace App\Http\Resources\Api\ProjectAttribute;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectAttributeResoruce extends JsonResource
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
            'type' => $this->type->value,
            'options' => $this->type->value == 'select' ? json_decode($this->options, true) :  __('n/a'),
        ];
    }
}
