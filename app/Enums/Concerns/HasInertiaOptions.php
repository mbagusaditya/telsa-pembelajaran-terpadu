<?php

namespace App\Enums\Concerns;

use BackedEnum;
use UnitEnum;

/**
 * @mixin BackedEnum
 * @mixin UnitEnum
 *
 * @method static array cases()
 */
trait HasInertiaOptions
{
    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'label' => method_exists($this, 'label') ? $this->label() : $this->name,
        ];
    }

    public static function options(): array
    {
        return array_map(
            fn(self $case) => $case->toArray(),
            static::cases()
        );
    }

    public static function values(): array
    {
        return array_column(static::cases(), 'value');
    }
}
