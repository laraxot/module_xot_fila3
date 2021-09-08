<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Support\Facades\File;

/**
 * Class PdfService.
 */
class PdfService {
    private static ?self $instance = null;

    public static function getInstance(): self {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    //include __DIR__.'/vendor/autoload.php';

    public function mergePdf(string $path): self {
        include __DIR__.'/vendor/autoload.php';
        $path = $this->get('path');
        $pdf = new \Jurosh\PDFMerge\PDFMerger();
        $pdf_files = collect(File::files($path))->filter(
            function ($file, $key) {
                //dddx(get_class_methods($file));
                //dddx($file->getBasename());
                return 'pdf' == $file->getExtension() && ! Str::startsWith($file->getBasename(), '_');
            }
        );

        $pdf->addPDF($filename.'.pdf');
        foreach ($pdf_files as $pdf_file) {
            $pdf_path = $pdf_file->getRealPath();
            //echo '<br/> ADD: '.$pdf_path;
            //if(! Str::startsWith($file, '_')
            $pdf->addPDF($pdf_path);
        }
        $pdf->merge('file', $path.'/_all.pdf');

        return $this;
    }
}
