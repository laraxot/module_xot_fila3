<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
/*
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\Storage;

\PhpOffice\PhpWord\TemplateProcessor($file);
https://stackoverflow.com/questions/41296206/read-and-replace-contents-in-docx-word-file
composer require phpoffice/phpword
https://github.com/wrklst/docxmustache

https://code-boxx.com/convert-html-to-docx-using-php/

*/

use PhpOffice\PhpWord\TemplateProcessor;

/**
 * Class DocxService.
 */
class DocxService {
    public string $docx_input;

    public array $values;

    private static ?self $instance = null;

    public function __construct() {
    }

    public static function getInstance(): self {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function make(): self {
        return static::getInstance();
    }

<<<<<<< HEAD
    // Method Modules\Xot\Services\DocxService::setDocxInput()
    // should return Modules\Xot\Services\DocxService
    // but returns Modules\Xot\Services\DocxService|null.
=======
    //Method Modules\Xot\Services\DocxService::setDocxInput()
    //should return Modules\Xot\Services\DocxService
    //but returns Modules\Xot\Services\DocxService|null.
>>>>>>> 9472ad4 (first)

    public function setDocxInput(string $filename): self {
        $this->docx_input = $filename;

        return $this;
    }

    public function setValues(array $values): self {
        $this->values = $values;

        return $this;
    }

    /**
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function out(array $params = []) {
        extract($params);
<<<<<<< HEAD
        include __DIR__.'/vendor/autoload.php'; // carico la mia libreria che uso solo qui..

        // return response()->download($this->docx_input);
        $tpl = new TemplateProcessor($this->docx_input);
        // $tpl->setValue('customer_title', 'test');
        $tpl->setValues($this->values);
        $info = pathinfo($this->docx_input);
        // dddx($info);
=======
        include __DIR__.'/vendor/autoload.php'; //carico la mia libreria che uso solo qui..

        //return response()->download($this->docx_input);
        $tpl = new TemplateProcessor($this->docx_input);
        //$tpl->setValue('customer_title', 'test');
        $tpl->setValues($this->values);
        $info = pathinfo($this->docx_input);
        //dddx($info);
>>>>>>> 9472ad4 (first)
        $filename_out = $info['basename'];
        $filename_out_path = storage_path($filename_out);
        try {
            $tpl->saveAs($filename_out_path);
        } catch (\Exception $e) {
<<<<<<< HEAD
            // handle exception
=======
            //handle exception
>>>>>>> 9472ad4 (first)
            dddx([$e]);
        }

        return response()->download($filename_out_path);
    }

    /**
<<<<<<< HEAD
     * @param \Illuminate\Contracts\Support\Arrayable $row
     * @param string                                  $prefix
=======
     * @param object $row
     * @param string $prefix
>>>>>>> 9472ad4 (first)
     *
     * @return array
     */
    public function rows2Data_test($row, $prefix) {
<<<<<<< HEAD
        if (! \is_object($row)) {
=======
        if (! is_object($row)) {
>>>>>>> 9472ad4 (first)
            return [];
        }

        $data = collect($row)->map(
            function ($item, $key) use ($prefix, $row) {
                if ($row->$key instanceof Carbon) {
                    $item = $row->$key->format('d/m/Y');
                    $item_year = $row->$key->format('Y');

                    return [
                        $prefix.'.'.$key => $item,
                        $prefix.'.'.$key.'_year' => $item_year,
                    ];
                }

                if (isJson($row->$key)) {
<<<<<<< HEAD
                    // dddx($row->$key);
                    $tmp = (array) json_decode($row->$key);
                    $data = [];
                    foreach ($tmp as $k => $v) {
                        if (! \is_array($v) && ! \is_object($v)) {
                            $data[$prefix.'.'.$key.'_'.$k] = $v;
                        }
                    }
                    // dddx($data);
                    return $data;
                }
                if (\is_string($item)) {
=======
                    //dddx($row->$key);
                    $tmp = (array) json_decode($row->$key);
                    $data = [];
                    foreach ($tmp as $k => $v) {
                        if (! is_array($v) && ! is_object($v)) {
                            $data[$prefix.'.'.$key.'_'.$k] = $v;
                        }
                    }
                    //dddx($data);
                    return $data;
                }
                if (is_string($item)) {
>>>>>>> 9472ad4 (first)
                    $item = str_replace('&', '&amp;', $item);
                }

                return [
                    $prefix.'.'.$key => $item,
                ];
            }
        )
            ->collapse()
            ->all();

        return $data;
    }

    /**
     * @param Model  $row
     * @param string $prefix
     *
     * @return array
     */
    public function rows2Data($row, $prefix) {
<<<<<<< HEAD
        if (! \is_object($row)) {
=======
        if (! is_object($row)) {
>>>>>>> 9472ad4 (first)
            return [];
        }

        $arr = [];
        $fields = $row->getFillable();
        foreach ($fields as $field) {
<<<<<<< HEAD
            // 175    Dead catch - Exception is never thrown in the try block.
            // try {
            $arr[$field] = $row->$field;
            // } catch (\Exception $e1) {
            //    $arr[$field] = '';
            // }
        }

        // $arr = $row->toArray();
        // dddx($arr);
        $data = collect($arr)->map(
            function ($item, $key) use ($row, $prefix, $arr) {
                // *
                if ('' !== $arr[$key] && \is_object($row->$key)) {
=======
            //175    Dead catch - Exception is never thrown in the try block.
            //try {
            $arr[$field] = $row->$field;
            //} catch (\Exception $e1) {
            //    $arr[$field] = '';
            //}
        }

        //$arr = $row->toArray();
        //dddx($arr);
        $data = collect($arr)->map(
            function ($item, $key) use ($row, $prefix, $arr) {
                //*
                if ('' != $arr[$key] && is_object($row->$key)) {
>>>>>>> 9472ad4 (first)
                    if ($row->$key instanceof Carbon) {
                        try {
                            $item = $row->$key->format('d/m/Y');
                        } catch (\Exception $e) {
                            return [
                                $prefix.'.'.$key => $item,
                            ];
                        }
<<<<<<< HEAD
                        // Carbon::setLocale('it');
=======
                        //Carbon::setLocale('it');
>>>>>>> 9472ad4 (first)
                        return [
                            $prefix.'.'.$key => $item,
                            $prefix.'.'.$key.'_locale' => ucfirst($row->$key->translatedFormat('d F Y')),
                            $prefix.'.'.$key.'_dm' => ucfirst($row->$key->translatedFormat('d F')),
                            $prefix.'.'.$key.'_year' => $row->$key->format('Y'),
                        ];
                    }
                }
<<<<<<< HEAD
                // */

                if (isJson($row->$key)) {
                    // dddx($row->$key);
                    $tmp = (array) json_decode($row->$key);
                    $data = [];
                    foreach ($tmp as $k => $v) {
                        if (! \is_array($v) && ! \is_object($v)) {
                            $data[$prefix.'.'.$key.'_'.$k] = $v;
                        }
                    }
                    // dddx($data);
                    return $data;
                }
                if (\is_string($item)) {
=======
                //*/

                if (isJson($row->$key)) {
                    //dddx($row->$key);
                    $tmp = (array) json_decode($row->$key);
                    $data = [];
                    foreach ($tmp as $k => $v) {
                        if (! is_array($v) && ! is_object($v)) {
                            $data[$prefix.'.'.$key.'_'.$k] = $v;
                        }
                    }
                    //dddx($data);
                    return $data;
                }
                if (is_string($item)) {
>>>>>>> 9472ad4 (first)
                    $item = str_replace('&', '&amp;', $item);
                }

                return [$prefix.'.'.$key => $item];
            }
        )->collapse()
        ->all();
<<<<<<< HEAD
        // 212    Offset non-empty-string on array<int, mixed> in isset() does not exist.
        // if (isset($data[$prefix.'.postal_code'])) {
        // $data[$prefix.'.zip_code'] = $data[$prefix.'.postal_code'] ?? '';
        // }

        /* -- per fare buono phpstan
        if (isset($data[$prefix.'.route'])
            && isset($data[$prefix.'.locality'])
            && isset($data[$prefix.'.zip_code'])
            // && !isset($data[$prefix.'.full_address'])
        ) {
            $data[$prefix.'.full_address'] = $data[$prefix.'.route'].', '.$data[$prefix.'.street_number'].' - '.$data[$prefix.'.zip_code'].' '.$data[$prefix.'.locality'].' ('.$data[$prefix.'.administrative_area_level_2_short'].')';
        }
        */

        return $data;
    }
}// end class
=======

        if (isset($data[$prefix.'.postal_code'])) {
            $data[$prefix.'.zip_code'] = $data[$prefix.'.postal_code'];
        }

        if (isset($data[$prefix.'.route'])
            && isset($data[$prefix.'.locality'])
            && isset($data[$prefix.'.zip_code'])
            //&& !isset($data[$prefix.'.full_address'])
        ) {
            $data[$prefix.'.full_address'] = $data[$prefix.'.route'].', '.$data[$prefix.'.street_number'].' - '.$data[$prefix.'.zip_code'].' '.$data[$prefix.'.locality'].' ('.$data[$prefix.'.administrative_area_level_2_short'].')';
        }

        return $data;
    }
}//end class
>>>>>>> 9472ad4 (first)

/*
https://appdividend.com/2018/04/23/how-to-create-word-document-file-in-laravel/
*/

/*
$templateProcessor->cloneRow('rowValue', 10);
$templateProcessor->setValue('rowValue#1', htmlspecialchars('Sun'));
$templateProcessor->setValue('rowValue#2', htmlspecialchars('Mercury'));
$templateProcessor->setValue('rowValue#3', htmlspecialchars('Venus'));
$templateProcessor->setValue('rowValue#4', htmlspecialchars('Earth'));
$templateProcessor->setValue('rowValue#5', htmlspecialchars('Mars'));
$templateProcessor->setValue('rowValue#6', htmlspecialchars('Jupiter'));
$templateProcessor->setValue('rowValue#7', htmlspecialchars('Saturn'));
$templateProcessor->setValue('rowValue#8', htmlspecialchars('Uranus'));
$templateProcessor->setValue('rowValue#9', htmlspecialchars('Neptun'));
$templateProcessor->setValue('rowValue#10', htmlspecialchars('Pluto'));
$templateProcessor->setValue('rowNumber#1', htmlspecialchars('1'));
$templateProcessor->setValue('rowNumber#2', htmlspecialchars('2'));
$templateProcessor->setValue('rowNumber#3', htmlspecialchars('3'));
$templateProcessor->setValue('rowNumber#4', htmlspecialchars('4'));
$templateProcessor->setValue('rowNumber#5', htmlspecialchars('5'));
$templateProcessor->setValue('rowNumber#6', htmlspecialchars('6'));
$templateProcessor->setValue('rowNumber#7', htmlspecialchars('7'));
$templateProcessor->setValue('rowNumber#8', htmlspecialchars('8'));
$templateProcessor->setValue('rowNumber#9', htmlspecialchars('9'));
$templateProcessor->setValue('rowNumber#10', htmlspecialchars('10'));
*/

/*
// Creating the new document...
$zip = new \PhpOffice\PhpWord\Shared\ZipArchive();

//This is the main document in a .docx file.
$fileToModify = 'word/document.xml';

$file = public_path('template.docx');
$temp_file = storage_path('/app/'.date('Ymdhis').'.docx');
copy($template,$temp_file);

if ($zip->open($temp_file) === TRUE) {
    //Read contents into memory
    $oldContents = $zip->getFromName($fileToModify);

    echo $oldContents;

    //Modify contents:
    $newContents = str_replace('{officeaddqress}', 'Yahoo \n World', $oldContents);
    $newContents = str_replace('{name}', 'Santosh Achari', $newContents);

    //Delete the old...
    $zip->deleteName($fileToModify);
    //Write the new...
    $zip->addFromString($fileToModify, $newContents);
    //And write back to the filesystem.
    $return =$zip->close();
    If ($return==TRUE){
        echo "Success!";
    }
} else {
    echo 'failed';
}
*/

/*
$full_path = 'template.docx';
    //Copy the Template file to the Result Directory
    copy($template_file_name, $full_path);

    // add calss Zip Archive
    $zip_val = new ZipArchive;

    //Docx file is nothing but a zip file. Open this Zip File
    if($zip_val->open($full_path) == true)
    {
        // In the Open XML Wordprocessing format content is stored.
        // In the document.xml file located in the word directory.

        $key_file_name = 'word/document.xml';
        $message = $zip_val->getFromName($key_file_name);

        $timestamp = date('d-M-Y H:i:s');

        // this data Replace the placeholders with actual values
        $message = str_replace("{officeaddress}", "onlinecode org", $message);
        $message = str_replace("{Ename}", "ingo@onlinecode.org", $message);
        $message = str_replace("{name}", "www.onlinecode.org", $message);

        //Replace the content with the new content created above.
        $zip_val->addFromString($key_file_name, $message);
        $zip_val->close();
    }
    */
