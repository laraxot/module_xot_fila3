<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Class ArrayService.
 */
class ArrayService {
    protected int $export_processor = 1;

    public array $array;
    public ?string $filename = null;

    private static ?self $instance = null;

    public function __construct() {
        // ---
        include_once __DIR__.'/vendor/autoload.php';
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

    public function getArray(): array {
        return $this->array;
    }

    public function setArray(array $array): self {
        $this->array = $array;

        return $this;
    }

    public function setFilename(string $filename): self {
        $this->filename = $filename;

        return $this;
    }

    public function getFilename(): string {
        $filename = $this->filename;
        if (null !== $filename) {
            return $filename;
        }
        // dddx(debug_backtrace());
        return 'test';
    }

    // ret array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string|\Symfony\Component\HttpFoundation\BinaryFileResponse

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     *
     * @return mixed
     */
    public function toXLS() {
        if (1 === request('debug', 0) * 1) {
            return self::toHtml();
        }
        // include_once __DIR__.'/vendor/autoload.php';
        $data = $this->array;
        $res = [];
        foreach ($data as $k => $v) {
            foreach ($v as $k0 => $v0) {
                if (! \is_array($v0)) {
                    $res[$k][$k0] = $v0;
                }
            }
        }
        $this->array = $res;

        switch ($this->export_processor) {
            case 1:
                return self::toXLS_phpoffice(); // break;
                // case 2:return self::toXLS_Maatwebsite($params); //break;
                // case 3:return self::toXLS_phpexcel($params); //break;
            default:
                dddx(['unknown export_processor ['.$this->export_processor.']']);
                break;
        }
    }

    public function toHtml(): string {
        $header = $this->getHeader();
        $data = $this->getArray();
        $html = '';
        $html .= '<table border="1">';
        $html .= '<thead>';
        $html .= '<tr>';
        foreach ($header as $k => $v) {
            $html .= '<th>'.$v.'</th>';
        }

        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach ($data as $k => $v) {
            $html .= '<tr>';
            foreach ($v as $v0) {
                if (\is_string($v0) || is_numeric($v0) || null === $v0) {
                    $html .= '<td><pre>'.$v0.'</pre></td>';
                } elseif (\is_array($v0)) {
                    $html .= '<td><pre>'.print_r($v0, true).'</pre></td>';
                } else {
                    $html .= '<td><pre>NOT STRING</pre></td>';
                }
            }
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';

        return $html;
    }

    public function getHeader(): array {
        $data = $this->array;
        $firstrow = collect($data)->first();
        if (! \is_array($firstrow)) {
            $firstrow = [];
        }
        $header = array_keys($firstrow);

        $debug = debug_backtrace();
        if (isset($debug[2]['file'])) {
            $mod_trad = getModTradFilepath($debug[2]['file']);

            return TranslatorService::getArrayTranslated($mod_trad, $header);
        }

        return $header;
    }

    // ret array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string|\Symfony\Component\HttpFoundation\BinaryFileResponse

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     *
     * @return mixed
     */
    public function toXLS_phpoffice() {
        $spreadsheet = new Spreadsheet();
        // ----
        $ltr = 'A1';
        // ----
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getStyle($ltr)->getAlignment()->setWrapText(true);

        $header = $this->getHeader();
        $data = $this->array;
        $filename = $this->getFilename();

        $sheet->fromArray($header, null, 'A1');
        $sheet->fromArray(
            $data,      // The data to set
            null,        // Array values with this value will not be set
            'A2'         // Top left coordinate of the worksheet range where
            //    we want to set these values (default is A1)
        );
        // $sheet->setCellValue('A1', 'Hello World !');
        $writer = new Xlsx($spreadsheet);

        $pathToFile = Storage::disk('local')->path($filename.'.xlsx');
        $writer->save($pathToFile); // $writer->save('php://output'); // per out diretto ?

        $view_params = [
            'file' => $pathToFile,
            'ext' => 'xls',
            'text' => '.',
            // 'text'=>$text,
        ];

        // if (! isset($out)) {
        $out = 'download';
        // return response()->download($pathToFile);
        // $out='link';
        // exit(response()->download($pathToFile));
        // }
        //Variable $text in isset() is never defined
        //if (! isset($text)) {
        //    $text = 'text';
        //}
        switch ($out) {
        case 'link':
            return view()->make('theme::download_icon', $view_params);
        case 'download':
            return response()->download($pathToFile);
        case 'file':
            return $pathToFile;
        case 'link_file':
            return view()->make('theme::download_icon', $view_params);

            // return [$link, $pathToFile];
        }
    }

    public static function save(array $params): void {
        extract($params);
        if (! isset($data)) {
            dddx(['err' => 'data is missing']);

            return;
        }
        if (! isset($filename)) {
            dddx(['filename' => 'filename is missing']);

            return;
        }
        $content = var_export($data, true);

        // HHVM fails at __set_state, so just use object cast for now
        $content = str_replace('stdClass::__set_state', '(object)', $content);

        $content = '<'.'?php '.\chr(13).'return '.$content.';'.\chr(13);
        // $content = str_replace('stdClass::__set_state', '(object)', $content);
        File::makeDirectory(\dirname($filename), 0775, true, true);
        File::put($filename, $content);
    }

    /**
     * Undocumented function.
     *
     * @param array|object $arrObjData
     * @param array        $arrSkipIndices
     *
     * @return array
     */
    public static function fromObjects($arrObjData, $arrSkipIndices = []) {
        $arrData = [];

        // if input is object, convert into array
        if (\is_object($arrObjData)) {
            $arrObjData = get_object_vars($arrObjData);
        }

        if (\is_array($arrObjData)) {
            foreach ($arrObjData as $index => $value) {
                if (\is_object($value) || \is_array($value)) {
                    $value = self::fromObjects($value, $arrSkipIndices); // recursive call
                }
                if (\in_array($index, $arrSkipIndices, true)) {
                    continue;
                }
                $arrData[$index] = $value;
            }
        }

        return $arrData;
    }

    /**
     * Undocumented function.
     *
     * @param int $a0
     * @param int $b0
     * @param int $a1
     * @param int $b1
     *
     * @return array|bool
     */
    public static function rangeIntersect($a0, $b0, $a1, $b1) {
        if ($a1 >= $a0 && $a1 <= $b0 && $b0 <= $b1) {
            return [$a1, $b0];
        }
        if ($a0 >= $a1 && $a0 <= $b0 && $b0 <= $b1) {
            return [$a0, $b0];
        }
        if ($a1 >= $a0 && $a1 <= $b1 && $b1 <= $b0) {
            return [$a1, $b1];
        }
        if ($a0 >= $a1 && $a0 <= $b1 && $b1 <= $b0) {
            return [$a0, $b1];
        }

        return false;
    }

    /**
     * Undocumented function
     *
     * @param array<int, mixed> $data
     * @return array
     */
    public static function fixType(array $data): array {
        $res = collect($data)
            ->map(
                function ($item) {
                    //Unable to resolve the template type TKey in call to function collect
                    //Unable to resolve the template type TValue in call to function collect
                    /**
                    * @template T
                    * @param T $item
                    */       
                    $item = collect($item)
                        ->map(
                            function ($item0) {
                                if (is_numeric($item0)) {
                                    $item0 = $item0 * 1;
                                }

                                return $item0;
                            }
                        )->all();

                    return $item;
                }
            );

        return $res->all();
    }

    /**
     * Undocumented function.
     */
    public static function diff_assoc_recursive(array $arr_1, array $arr_2): array {
        $coll_1 = collect(self::fixType($arr_1));
        $arr_2 = self::fixType($arr_2);

        $ris = $coll_1->filter(
            function ($value, $key) use ($arr_2) {
                try {
                    return ! \in_array($value, $arr_2, true);
                } catch (\Exception $e) {
                    dddx(['err' => $e->getMessage(), 'value' => $value, 'key' => $key, 'arr_2' => $arr_2]);
                }
            }
        );

        return $ris->all();
    }
}