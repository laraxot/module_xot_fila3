<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Xot\Http\Controllers\PrivacyPolicyController;
use Modules\Xot\Http\Controllers\TermsOfServiceController;

Route::group(['middleware' => ['web']], function () {
    Route::get('/terms-of-service', [TermsOfServiceController::class, 'show'])->name('terms.show');
    Route::get('/privacy-policy', [PrivacyPolicyController::class, 'show'])->name('policy.show');
});