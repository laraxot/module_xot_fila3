<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Exception;
<<<<<<< HEAD

// use Modules\Tenant\Services\TenantService;
=======
use Modules\Tenant\Services\TenantService;
>>>>>>> 9472ad4 (first)

/**
 * Class ActionService.
 */
class ActionService {
    /**
     * Undocumented function.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments) {
<<<<<<< HEAD
        // $xot = TenantService::config('xra');
        $xot = config('xra');
        if (! \is_array($xot)) {
            throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
        }
        $theme = inAdmin() ? $xot['adm_theme'] : $xot['pub_theme'];
        // $theme = 'AdminLTE';
=======
        $xot = TenantService::config('xra');
        if (! is_array($xot)) {
            throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
        }
        $theme = inAdmin() ? $xot['adm_theme'] : $xot['pub_theme'];
        //$theme = 'AdminLTE';
>>>>>>> 9472ad4 (first)
        $action_class = '\Themes\\'.$theme.'\Actions\RootAction';

        return app($action_class)->{$name}(...$arguments);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9472ad4 (first)
