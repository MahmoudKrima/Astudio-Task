<?php

namespace App\Models;

use App\Enum\AttributeTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];
    protected $casts = [
        'options' => 'array',
        'type' => AttributeTypeEnum::class,

    ];
    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
