<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Class PdfService.
 */
class PdfService {
    public array $filenames = [];

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
        //$path = $this->get('path');
        $pdf = new \Jurosh\PDFMerge\PDFMerger();
        $pdf_files = collect(File::files($path))->filter(
            function ($file, $key) {
                //dddx(get_class_methods($file));
                //dddx($file->getBasename());
                return 'pdf' == $file->getExtension() && ! Str::startsWith($file->getBasename(), '_');
            }
        );
        foreach ($this->filenames as $filename) {
            //$pdf->addPDF($filename.'.pdf');
            $pdf->addPDF($filename);
        }
        foreach ($pdf_files as $pdf_file) {
            $pdf_path = $pdf_file->getRealPath();
            //echo '<br/> ADD: '.$pdf_path;
            //if(! Str::startsWith($file, '_')
            $pdf->addPDF($pdf_path);
        }
        $pdf->merge('file', $path.'/_all.pdf');

        return $this;
    }

    public function addFilenames(array $filenames): self {
        $this->filenames = array_merge($this->filenames, $filenames);

        return $this;
    }
}
