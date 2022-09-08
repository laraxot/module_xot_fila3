<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

<<<<<<< HEAD
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
=======
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
>>>>>>> 9472ad4 (first)

/**
 * Class PdfService.
 */
<<<<<<< HEAD
class PdfService {
=======
class PdfService
{
>>>>>>> 9472ad4 (first)
    public array $filenames = [];

    private static ?self $instance = null;

<<<<<<< HEAD
    public function __construct() {
        // ---
        include_once __DIR__.'/vendor/autoload.php';
    }

    public static function getInstance(): self {
=======
    public static function getInstance(): self
    {
>>>>>>> 9472ad4 (first)
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

<<<<<<< HEAD
    public static function make(): self {
        return static::getInstance();
    }

    // include __DIR__.'/vendor/autoload.php';

    public function mergePdf(string $path): self {
        include __DIR__.'/vendor/autoload.php';
        // $path = $this->get('path');
        if(!class_exists(\Jurosh\PDFMerge\PDFMerger::class)){
            throw new Exception ('['.__LINE__.']['.__FILE__.']');
        }
        $pdf = new \Jurosh\PDFMerge\PDFMerger();
        $pdf_files = collect(File::files($path))->filter(
            function ($file, $key) {
                // dddx(get_class_methods($file));
                // dddx($file->getBasename());
                return 'pdf' === $file->getExtension() && ! Str::startsWith($file->getBasename(), '_');
            }
        );
        foreach ($this->filenames as $filename) {
            // $pdf->addPDF($filename.'.pdf');
=======
    //include __DIR__.'/vendor/autoload.php';

    public function mergePdf(string $path): self
    {
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
>>>>>>> 9472ad4 (first)
            $pdf->addPDF($filename);
        }
        foreach ($pdf_files as $pdf_file) {
            $pdf_path = $pdf_file->getRealPath();
<<<<<<< HEAD
            // echo '<br/> ADD: '.$pdf_path;
            // if(! Str::startsWith($file, '_')
=======
            //echo '<br/> ADD: '.$pdf_path;
            //if(! Str::startsWith($file, '_')
>>>>>>> 9472ad4 (first)
            $pdf->addPDF($pdf_path);
        }
        $pdf->merge('file', $path.'/_all.pdf');

        return $this;
    }

<<<<<<< HEAD
    public function addFilenames(array $filenames): self {
=======
    public function addFilenames(array $filenames): self
    {
>>>>>>> 9472ad4 (first)
        $this->filenames = array_merge($this->filenames, $filenames);

        return $this;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9472ad4 (first)
