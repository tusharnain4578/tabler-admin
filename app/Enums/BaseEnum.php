<?php

namespace App\Enums;
use Illuminate\Support\Collection;

abstract class BaseEnum
{
    public static function all(): Collection
    {
        return collect(static::array());
    }
    public static function array(): array
    {
        $reflectionClass = new \ReflectionClass(static::class);
        return array_values($reflectionClass->getConstants());
    }
}