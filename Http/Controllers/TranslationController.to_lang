<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use File;
// ---- services --
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Services\TranslatorService;

/**
 * Class TranslationController.
 */
class TranslationController extends Controller {
    /**
     * @return mixed
     */
    public function index(Request $request) {
        return ThemeService::view();
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $data = $request->all();
        $trans = $data['trans'];
        TranslatorService::store($trans);
        if (\Request::ajax()) {
            $response = [
                'success' => true,
                // 'data'    => $result,
                'message' => 'OK',
            ];
            $response = array_merge($data, $response);

            return response()->json($response, 200);
        }

        return redirect()->back();
    }
}
