<?php
/**
 * @see https://www.itsolutionstuff.com/post/laravel-9-import-export-excel-and-csv-file-tutorialexample.html
 */

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

<<<<<<< HEAD
use Modules\Theme\Services\ThemeService;
=======
use Modules\LU\Models\User;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Services\ArrayService;
use Modules\Xot\Services\XLSService;
>>>>>>> 9472ad4 (first)

/**
 * Class ModelGeneratorAction.
 */
class ModelGeneratorAction extends XotBasePanelAction {
    public bool $onItem = true;

    public string $icon = '<i class="fa fa-table"></i>';

    /**
     * @return mixed
     */
    public function handle() {
<<<<<<< HEAD
        /*
        $view = ThemeService::getView(); // xot::admin.home.acts.xls_import
=======
        $view = ThemeService::getView(); //xot::admin.home.acts.xls_import
>>>>>>> 9472ad4 (first)
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
<<<<<<< HEAD
        */
        return $this->panel->out();
=======
>>>>>>> 9472ad4 (first)
    }

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function postHandle() {
<<<<<<< HEAD
    }
=======
        
    }

>>>>>>> 9472ad4 (first)
}