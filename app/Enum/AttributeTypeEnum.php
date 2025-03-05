<?php

namespace App\Enum;

enum AttributeTypeEnum: string
{
    case TEXT  = 'text';
    case DATE  = 'date';
    case NUMBER  = 'number';
    case SELECT  = 'select';

    public function lang(): string
    {
        return match ($this) {
            self::TEXT => __("api.text"),
            self::DATE => __("api.date"),
            self::NUMBER => __("api.number"),
            self::SELECT => __("api.select"),
        };
    }


    public static function vals(): array
    {
        return [
            self::TEXT->value,
            self::DATE->value,
            self::NUMBER->value,
            self::SELECT->value,
        ];
    }
}
