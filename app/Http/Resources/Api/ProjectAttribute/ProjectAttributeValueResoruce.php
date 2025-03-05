<?php

namespace App\Http\Resources\Api\ProjectAttribute;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectAttributeValueResoruce extends JsonResource
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
            'attribute' => $this->attribute ? new ProjectAttributeResoruce($this->attribute) :  __('n/a'),
            'value' => $this->value,
        ];
    }
}
