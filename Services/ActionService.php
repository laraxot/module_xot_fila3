<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Modules\Tenant\Services\TenantService;

/**
 * Class ActionService.
 */
class ActionService
{
    /**
     * Undocumented function.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        $xot = TenantService::config('xra');
        $theme = inAdmin() ? $xot['adm_theme'] : $xot['pub_theme'];
        //$theme = 'AdminLTE';
        $action_class = '\Themes\\'.$theme.'\Actions\RootAction';

        return app($action_class)->{$name}(...$arguments);
    }
}
