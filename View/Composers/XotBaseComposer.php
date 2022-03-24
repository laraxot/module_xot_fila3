<?php

declare(strict_types=1);

namespace Modules\Xot\View\Composers;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Theme\Models\Menu;
use Modules\Theme\Models\MenuItem;

/**
 * --.
 */
abstract class XotBaseComposer {
    /**
     * --.
     */
    public function getMenuByName(string $name): Menu {
        return  Menu::firstWhere('name', $name);
    }

    /**
     * --.
     */
    public function getMenuItemsByName(string $name): Collection {
        $rows = Menu::firstWhere('name', $name)->items;
        //$sql = Str::replaceArray('?', $rows->getBindings(), $rows->toSql());
        //$test = MenuItem::where('menu', 2)->get();
        //dddx(
        //    [
        //'sql' => $sql,
        //'test' => $test,
        //'rows' => $rows,
        //]
        //);
        return $rows;
    }
}
