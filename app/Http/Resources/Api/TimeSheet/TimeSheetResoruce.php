<?php

namespace App\Http\Resources\Api\TimeSheet;

use App\Http\Resources\Api\Project\ShortProjectResoruce;
use App\Http\Resources\Api\User\ShortUserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimeSheetResoruce extends JsonResource
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
            'task_name' => $this->task_name,
            'date' => $this->date,
            'user' => new ShortUserResource($this->user),
            'project' => new ShortProjectResoruce($this->project),
        ];
    }
}
