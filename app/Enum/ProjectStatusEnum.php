<?php

namespace App\Enum;

enum ProjectStatusEnum: string
{
    case PENDING  = 'pending';
    case ACTIVE  = 'active';
    case ENDED  = 'ended';

    public function lang(): string
    {
        return match ($this) {
            self::PENDING => __("api.pending"),
            self::ACTIVE => __("api.active"),
            self::ENDED => __("api.ended"),
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::PENDING => 'btn btn-warning text-center',
            self::ACTIVE => 'btn btn-success text-center',
            self::ENDED => 'btn btn-danger text-center',
        };
    }

    public static function vals(): array
    {
        return [
            self::PENDING->value,
            self::ACTIVE->value,
            self::ENDED->value,
        ];
    }
}
