<?php

declare(strict_types=1);

namespace Modules\Xot\Providers\Traits;

<<<<<<< HEAD
// --- services ---
use Illuminate\Translation\Translator;
use Modules\Xot\Services\TranslatorService;

trait TranslatorTrait {
    public function registerTranslator(): void {
=======
//--- services ---
use Illuminate\Translation\Translator;
use Modules\Xot\Services\TranslatorService;

trait TranslatorTrait
{
    public function registerTranslator(): void
    {
>>>>>>> 9472ad4 (first)
        // Override the JSON Translator
        $this->app->extend(
            'translator', function (Translator $translator) {
                $trans = new TranslatorService($translator->getLoader(), $translator->getLocale());
                $trans->setFallback($translator->getFallback());

                return $trans;
            }
        );
    }
}
