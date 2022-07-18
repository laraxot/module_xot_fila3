<?php

declare(strict_types=1);

namespace Modules\Xot\View\Composers;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Theme\Models\Menu;
use Illuminate\Support\Collection;
use Modules\Theme\Models\MenuItem;
use Nwidart\Modules\Facades\Module;

/**
 * --.
 */
abstract class XotBaseComposer {
    /**
     * Undocumented variable.
     */
    public string $module_name = '';

    /**
     * Undocumented function
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        // Note: value of $name is case sensitive.
        //echo "Calling object method '$name' "
        //     . implode(', ', $arguments). "\n";
        /*
        $modules = Module::getByStatus(1);
        $allEnabled = Module::allEnabled();
        dddx(
            [
                'name'=>$name,
                'arguments'=>$arguments,
                'modules'=>$modules,
                'allEnabled'=>$allEnabled,
                'cool'=>Module::collections(),
                'order'=>Module::getOrdered(),
            ]
        );
        */
        $modules=Module::getOrdered();
        $module = Arr::first(
            $modules,
            function ($module) use($name){
                $class='\Modules\\'.$module->getName().'\View\Composers\ThemeComposer';
                return method_exists($class,$name);
            }
        );
        if(!is_object($module)){
            throw new Exception('create a View\Composers\ThemeComposer.php inside a module with ['.$name.'] method');
        }
        $class='\Modules\\'.$module->getName().'\View\Composers\ThemeComposer';
        return call_user_func_array([app($class), $name], $arguments);
    }

    /**
     * Undocumented function.
     */
    public function setModule(string $module_name): self {
        $this->module_name = $module_name;

        return $this;
    }

    /**
     * Undocumented function.
     *
     * @param array|string|int|float|null ...$args
     *
     * @return mixed
     */
    public function call(string $func, ...$args) {
        $module = Module::find($this->module_name);

        $view_composer_class = 'Modules\\'.$module->getName().'\\View\Composers\\'.$module->getName().'Composer';
        if (! class_exists($view_composer_class)) {
            throw new Exception('['.$view_composer_class.']['.__LINE__.']['.__FILE__.']');
        }
        $view_composer = app($view_composer_class);

        return $view_composer->{$func}(...$args);
        // dddx([$view_composer, class_exists($view_composer)]);
    }

    /**
     * --.
     */
    public function getMenuByName(string $name): ?Menu {
        return Menu::firstWhere('name', $name);
    }

    /**
     * --.
     */
    public function getMenuItemsByName(string $name): Collection {
        $menu = Menu::firstWhere('name', $name);
        if (null === $menu) {
            return collect([]);
        }
        $rows = $menu->items;
        // $sql = Str::replaceArray('?', $rows->getBindings(), $rows->toSql());
        // $test = MenuItem::where('menu', 2)->get();
        // dddx(
        //    [
        // 'sql' => $sql,
        // 'test' => $test,
        // 'rows' => $rows,
        // ]
        // );
        return $rows;
    }
}