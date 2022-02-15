<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Tenant\Services\TenantService;

/**
 * Undocumented class.
 */
class PrivacyPolicyController extends Controller {
    /**
     * Show the privacy policy for the application.
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request) {
        $policyFile = TenantService::localizedMarkdownPath('policy.md');
        $content = file_get_contents($policyFile);
        if (false === $content) {
            throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
        }

        return view(
            'xot::gdpr.policy', [
                'policy' => Str::markdown($content),
            ]
        );
    }
}