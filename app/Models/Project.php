<?php

namespace App\Models;

use App\Enum\ProjectStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    protected function casts(): array
    {
        return [
            'status' => ProjectStatusEnum::class,
        ];
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_users');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }

    public function attributes()
    {
        return $this->hasMany(AttributeValue::class, 'entity_id', 'id');
    }
}
