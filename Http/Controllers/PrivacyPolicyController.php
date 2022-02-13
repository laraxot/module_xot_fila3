<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Tenant\Services\TenantService;

class PrivacyPolicyController extends Controller
{
    /**
     * Show the privacy policy for the application.
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        $policyFile = TenantService::localizedMarkdownPath('policy.md');

        return view(
            'xot::gdpr.policy', [
            'policy' => Str::markdown(file_get_contents($policyFile)),
            ]
        );
    }
}
