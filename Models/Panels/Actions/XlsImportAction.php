<?php
/**
 * @see https://www.itsolutionstuff.com/post/laravel-9-import-export-excel-and-csv-file-tutorialexample.html
 */

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

use Illuminate\Contracts\Support\Renderable;
use Modules\LU\Models\User;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Services\ArrayService;
use Modules\Xot\Services\XLSService;

/**
 * Class XlsImportAction.
 */
class XlsImportAction extends XotBasePanelAction {
    public bool $onItem = true;

    public string $icon = '<i class="far fa-file-excel fa-1x"></i>';

    /**
     * @return mixed
     */
    public function handle() {
        $view = ThemeService::getView(); // xot::admin.home.acts.xls_import
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
        $step = request('input', 1);
        $func = 'step'.$step;

        return $this->{$func}();
    }

    public function step1(): Renderable {
        // Excel::import(new UsersImport,request()->file('file'));
        $step = 1;
        // $c = request()->file('file'); // Illuminate\Http\UploadedFile
        $res = XLSService::make()->fromInputFileName('file');
        // $res = XLSService::make()->fromRequestFile($c);
        $data = $res->getData()->take(5)->toArray();
        /**
         * @var array
         */
        $first_row=collect($data)->first();

        $head = array_keys($first_row);

        $html = ArrayService::make()->setArray($data)->toHtml();

        $fillable = app(User::class)->getFillable();

        $view = ThemeService::getView(); // xot::admin.home.acts.xls_import

        $view .= '.step'.$step;
        $view_params = [
            'view' => $view,
            'data' => $data,
            'head' => $head,
            'data_html' => $html,
            'fillable' => $fillable,
        ];

        return view()->make($view, $view_params);
    }

    /**
     * WIP WIP WIP.
     *
     * @return mixed
     */
    public function step2() {
        // Excel::import(new UsersImport,request()->file('file'));
    }
}