<?php

function is_production(): bool
{
    return !!app()->environment('production');
}

function array_equals(array $a, array $b): bool
{
    return empty(array_diff($a, $b)) && empty(array_diff($b, $a));
}

function format_date(\Carbon\Carbon|string $date): string
{
    $cleanDateTimeFormat = config('settings.clean_datetime_format');
    if (is_string($date)) {
        return date($cleanDateTimeFormat, strtotime($date));
    }
    return $date->format($cleanDateTimeFormat);
}