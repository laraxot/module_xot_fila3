<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

<<<<<<< HEAD
// use Maatwebsite\Excel\Facades\Excel;
// use PHPExcel;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Exception;
// use Mpdf\Mpdf;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

=======
//use Maatwebsite\Excel\Facades\Excel;
//use PHPExcel;
//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Exception;
use Mpdf\Mpdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
>>>>>>> 9472ad4 (first)
/*
ExceptionFormatter
HtmlParsingException
ImageException
LocaleException
LongSentenceException
TableException
*/
<<<<<<< HEAD
=======
use Spipu\Html2Pdf\Html2Pdf;
>>>>>>> 9472ad4 (first)

/**
 * Class HtmlService.
 */
<<<<<<< HEAD
class HtmlService {
    /**
     * @return string
     */
    public static function toPdf(array $params) {
        // dddx($params);

        include_once __DIR__.'/vendor/autoload.php';
        $pdforientation = 'L'; // default;
=======
class HtmlService
{
    /**
     * @return string
     */
    public static function toPdf(array $params)
    {
        //dddx($params);

        include_once __DIR__.'/vendor/autoload.php';
        $pdforientation = 'L'; //default;
>>>>>>> 9472ad4 (first)
        $out = 'show';
        $filename = 'test';
        extract($params);
        if (! isset($html)) {
            throw new Exception('err html is missing');
        }

        if (request('debug', false)) {
            return $html;
        }
<<<<<<< HEAD
        try {
            $html2pdf = new Html2Pdf($pdforientation, 'A4', 'it');
            $html2pdf->setTestTdInOnePage(false);
            $html2pdf->WriteHTML($html);

            switch ($out) {
=======
        //try {
        $html2pdf = new Html2Pdf($pdforientation, 'A4', 'it');
        $html2pdf->setTestTdInOnePage(false);
        $html2pdf->WriteHTML($html);

        switch ($out) {
>>>>>>> 9472ad4 (first)
        case 'content_PDF':
            return $html2pdf->Output($filename.'.pdf', 'S');
        case 'file': $html2pdf->Output($filename.'.pdf', 'F');

            return $filename;
        }

<<<<<<< HEAD
            return $html2pdf->Output();
        } catch (Html2PdfException $e) {
            $html2pdf->clean();

            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
        // } catch (HTML2PDF_exception $e) {
        // } catch (Html2PdfException $e) {
        //    echo '<pre>';
        //    \print_r($e);
        //    echo '</pre>';
        // }
        return $filename;
=======
        return $html2pdf->Output();
        //} catch (HTML2PDF_exception $e) {
        //} catch (Html2PdfException $e) {
        //    echo '<pre>';
        //    \print_r($e);
        //    echo '</pre>';
        //}
>>>>>>> 9472ad4 (first)
    }

    /*
    public static function toMpdf($html): string {
        require_once __DIR__.'/vendor/autoload.php';

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        return $mpdf->Output();
    }
    */
<<<<<<< HEAD
}
=======
}
>>>>>>> 9472ad4 (first)
