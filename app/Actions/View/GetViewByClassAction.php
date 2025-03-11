<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\View;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\QueueableAction\QueueableAction;
use Modules\Xot\Actions\Module\GetModuleNameByModelClassAction;

class GetViewByClassAction
{
    use QueueableAction;

    /**
     * "Modules\UI\Filament\Widgets\GroupWidget" => "ui::filament.widgets.group"
     * @return view-string
     */
    public function execute(string $class, string $suffix = ''): string
    {
        $module = Str::of($class)->betweenFirst('Modules\\', '\\')->toString();
        $module_low = Str::of($module)->lower()->toString();
        $after = Str::of($class)
            ->after('Modules\\'.$module.'\\')
            ->explode('\\')
            ->toArray();

        $mapped = Arr::map($after, function (string $value, int $key) use ($after) {
            if ($key > 0 && isset($after[$key - 1])) {
                $prevValue = $after[$key - 1];
                // Assicuriamoci che prevValue sia una stringa per PHPStan
                $prevValueStr = is_string($prevValue) ? $prevValue : (string)$prevValue;
                $singular = Str::of($prevValueStr)->singular()->toString();
                if (Str::endsWith($value, $singular)) {
                    $value = Str::of($value)->beforeLast($singular)->toString();
                }
            }
            return Str::of($value)->slug()->toString();
        });

        $implode = implode('.', $mapped);
        $view = $module_low.'::'.$implode.$suffix;
        if (!view()->exists($view)) {
            throw new \Exception('View not found: '.$view);
        }

        return $view;

    }
}
