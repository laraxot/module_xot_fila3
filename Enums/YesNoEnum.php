<?php

declare(strict_types=1);

namespace Modules\Xot\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum YesNoEnum: string implements HasColor, HasIcon, HasLabel
{
    case YES = 'f';
    case NO = 'm';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::YES => 'yes',
            self::NO => 'no',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::YES => 'success',
            self::NO => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::YES => 'fas-check',
            self::NO => 'fas-times',
        };
    }
}
