<?php

declare(strict_types=1);

namespace Modules\Xot\View\Composers;

use Illuminate\Support\Arr;
use Illuminate\View\View;
use Modules\Xot\Services\FileService;
use Nwidart\Modules\Facades\Module;
use Webmozart\Assert\Assert;

/**
 * Class XotComposer.
 */
class XotComposer
{
    /**
     * Bind data to the view..
     */
    public function compose(View $view): void
    {
        $lang = app()->getLocale();
        $view->with('lang', $lang);
        $view->with('_theme', $this);
    }

    public function asset(string $str): string
    {
        return asset(FileService::asset($str));
    }

    /**
     * Undocumented function.
     *
     * @param array<mixed|void> $arguments
     */
    public function __call(string $name, array $arguments): mixed
    {
        $modules = Module::getOrdered();

        $module = Arr::first(
            $modules,
            static function ($module) use ($name): bool {
                $class = '\Modules\\'.$module->getName().'\View\Composers\ThemeComposer';

                return method_exists($class, $name);
            }
        );
        if (! \is_object($module)) {
            throw new \Exception('create a View\Composers\ThemeComposer.php inside a module with ['.$name.'] method');
        }

        Assert::isInstanceOf($module, \Nwidart\Modules\Module::class);
        $class = '\Modules\\'.$module->getName().'\View\Composers\ThemeComposer';
        // Parameter #1 $callback of function call_user_func_array expects callable(): mixed, array{*NEVER*, string} given.
        $app = app($class);
        $callback = [$app, $name];
        Assert::isCallable($callback);

        return \call_user_func_array($callback, $arguments);
    }
}
