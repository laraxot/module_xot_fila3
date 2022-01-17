<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Barryvdh\Snappy\Facades\SnappyPdf;


/**
 * Class HtmlService.
 */
class GraphToPdfService {
    public static function test(string $view) {
        $pdf = SnappyPdf::loadView($view);

        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 5000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);

        return $pdf->download('chart.pdf');
    }
}
