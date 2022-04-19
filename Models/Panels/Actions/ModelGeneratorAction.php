<?php
/**
 * @see https://www.itsolutionstuff.com/post/laravel-9-import-export-excel-and-csv-file-tutorialexample.html
 */

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

use Modules\LU\Models\User;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Services\ArrayService;
use Modules\Xot\Services\XLSService;

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
        $view = ThemeService::getView(); //xot::admin.home.acts.xls_import
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function postHandle() {
        
    }

}