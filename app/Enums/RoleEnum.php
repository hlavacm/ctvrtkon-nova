<?php

namespace App\Enums;

enum RoleEnum: string
{
    case GUEST = "guest";
    case MEMBER = "member";
    case EDITOR = "editor";
    case ADMIN = "admin";

    public static function keys(): array
    {
        return array_column(RoleEnum::cases(), "value");
    }

    public static function options(): array
    {
        $keys = self::keys();
        return array_combine($keys, $keys);
    }
}
