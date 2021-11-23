<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Tenant\Services\TenantService;

class TermsOfServiceController extends Controller {
    /**
     * Show the terms of service for the application.
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request) {
        $termsFile = TenantService::localizedMarkdownPath('terms.md');

        return view('xot::gdpr.terms', [
            'terms' => Str::markdown(file_get_contents($termsFile)),
        ]);
    }
}