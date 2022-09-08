<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

<<<<<<< HEAD
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
// ---- services ---
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Modules\Theme\Services\ThemeService;
use Illuminate\Translation\Translator as BaseTranslator;

// dddx('leggo');
=======
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
//---- services ---
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Translation\Translator as BaseTranslator;
use Modules\Theme\Services\ThemeService;

//dddx('leggo');
>>>>>>> 9472ad4 (first)

/**
 * Class TranslatorService.
 */
class TranslatorService extends BaseTranslator {
    /**
     * get.
     *
     * @param string      $key
     * @param string|null $locale
     * @param bool        $fallback
     *
     * @return array|string
     */
    public function get($key, array $replace = [], $locale = null, $fallback = true) {
<<<<<<< HEAD
        // backtrace(true);
        // trans parte da xotbasepanel riga 1109 (per ora)
        // superdump([$key, $replace , $locale , $fallback ]);

        // *
        if (null == $locale) {
            $locale = app()->getLocale();
        }
        // */
        $translation = parent::get($key, $replace, $locale, $fallback);
        /*
        if ($key == $translation && ! Str::endsWith($key, '.')) {
            dddx(['key' => $key, 'translation' => $translation, 'replace' => $replace, 'locale' => $locale, 'fallback' => $fallback]);
        }
        indennitacondizionilavoro::servizio_esterno_reps.tab.create
        //*/

        // echo '<br>['.$key.']['.$translation.']';
        // $langs=ThemeService::__merge('langs', [$key=>$translation]);
        // $cache_key=Str::slug(req_uri().'_langs');
        // Cache::put($cache_key,$langs);
        // echo '<pre>';print_r($langs);echo '</pre>';
=======
        //backtrace(true);
        //trans parte da xotbasepanel riga 1109 (per ora)
        //superdump([$key, $replace , $locale , $fallback ]);
        //*
        if($locale==null){
            $locale=app()->getLocale();
        }
        //*/
        $translation = parent::get($key, $replace, $locale, $fallback);
        //dddx(['key'=>$key,'translation'=>$translation,'replace'=>$replace,'locale'=>$locale,'fallback'=>$fallback]);
        //echo '<br>['.$key.']['.$translation.']';
        //$langs=ThemeService::__merge('langs', [$key=>$translation]);
        //$cache_key=Str::slug(req_uri().'_langs');
        //Cache::put($cache_key,$langs);
        //echo '<pre>';print_r($langs);echo '</pre>';
>>>>>>> 9472ad4 (first)
        /*
        if ($translation === $key) {
            Log::warning('Language item could not be found.', [
                'language' => $locale ?? config('app.locale'),
                'id' => $key,
                'url' => config('app.url')
            ]);
        }
        */

        return $translation;
    }

    /**
     * getFromJson.
     *
     * @param string      $key
     * @param string|null $locale
     *
     * @return array|string
     */
    public function getFromJson($key, array $replace = [], $locale = null) {
        return $this->get($key, $replace, $locale);
    }

    public static function parse(array $params): array {
        dddx('a');
        $lang = app()->getLocale();
        extract($params);
        if (! isset($key)) {
            dddx(['err' => 'key is missing']);

            return [];
        }
        $translator = app('translator');
        $tmp = ($translator->parseKey($key));
        $namespace = $tmp[0];
        $group = $tmp[1];
        $item = $tmp[2];
        $trans = trans();
        $path = collect($trans->getLoader()->namespaces())->flip()->search($namespace);
        $filename = $path.'/'.$lang.'/'.$group.'.php';
        $filename = str_replace(['/', '\\'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $filename);
        $lang_dir = dirname(dirname($filename));

        return [
            'key' => str_replace(['[', ']'], ['.', ''], $key),
            'namespace' => $namespace,
            'group' => $group,
            'ns_group' => $namespace.'::'.$group,
            'item' => $item,
            'filename' => $filename,
            'file_exists' => File::exists($filename),
            'lang_dir' => $lang_dir,
<<<<<<< HEAD
            'dir_exists' => File::exists($lang_dir), // dir without lang
=======
            'dir_exists' => File::exists($lang_dir), //dir without lang
>>>>>>> 9472ad4 (first)
        ];
    }

    /**
     * @return void
     */
    public static function store(array $data) {
        $data = collect($data)->map(
            function ($v, $k) {
                $item = self::parse(['key' => $k]);
                $item['value'] = $v;

                return $item;
            }
        )
<<<<<<< HEAD
        // ->dd()
=======
        //->dd()
>>>>>>> 9472ad4 (first)
            ->filter(
                function ($v, $k) {
                    return $v['dir_exists'] && strlen($v['lang_dir']) > 3;
                }
            )
<<<<<<< HEAD
        ->groupBy(['ns_group'])  // risparmio salvataggi
        ->all();
        // dddx($data);
=======
        ->groupBy(['ns_group'])  //risparmio salvataggi
        ->all();
        //dddx($data);
>>>>>>> 9472ad4 (first)
        foreach ($data as $ns_group => $data0) {
            $rows = trans($ns_group);

            if (! is_array($rows)) {
<<<<<<< HEAD
                // dddx($rows);  //---- dovrei leggere il file o controllarlo intanto lo blokko non voglio sovrascrivere
=======
                //dddx($rows);  //---- dovrei leggere il file o controllarlo intanto lo blokko non voglio sovrascrivere
>>>>>>> 9472ad4 (first)
                $rows = [];
            }

            foreach ($data0 as $k => $v) {
                $key = Str::after($v['key'], $ns_group.'.');
                Arr::set($rows, $key, $v['value']);
            }

            $data = $rows;
            if (! isset($v)) {
                dddx(['err' => 'v is missing']);

                return;
            }
            $filename = $v['filename'];
<<<<<<< HEAD
            // echo '<h3>['.$filename.']</h3>';
=======
            //echo '<h3>['.$filename.']</h3>';
>>>>>>> 9472ad4 (first)
            ArrayService::save(['filename' => $filename, 'data' => $data]);
        }
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    public static function set($key, $value) {
        $lang = app()->getLocale();
        if (trans($key) == $value) {
            return;
<<<<<<< HEAD
        } // non serve salvare
=======
        } //non serve salvare
>>>>>>> 9472ad4 (first)

        $translator = app('translator');
        $tmp = ($translator->parseKey($key));
        $namespace = $tmp[0];
        $group = $tmp[1];
        $item = $tmp[2];
        $trans = trans();
        $path = collect($trans->getLoader()->namespaces())->flip()->search($namespace);
        $filename = $path.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.$group.'.php';

        $trad = $namespace.'::'.$group;
        $rows = (trans($trad));
        $item_keys = explode('.', $item);
        $item_keys = implode('"]["', $item_keys);
        $item_keys = '["'.$item_keys.'"]';
        $str = '$rows'.$item_keys.'="'.$value.'";';
        try {
<<<<<<< HEAD
            eval($str); // fa schifo ma funziona
=======
            eval($str); //fa schifo ma funziona
>>>>>>> 9472ad4 (first)
        } catch (\Exception $e) {
        }
        ArrayService::save(['data' => $rows, 'filename' => $filename]);

        Session::flash('status', 'Modifica Eseguita! ['.$filename.']');

        /*

        dddx($rows)



        dddx($item_keys);

        dddx($filename);
        */
    }

    public static function getFilePath(string $key): string {
        $lang = app()->getLocale();
        $translator = app('translator');
        [$namespace,$group,$item] = ($translator->parseKey($key));
        $trans = trans();
        $path = collect($trans->getLoader()->namespaces())->flip()->search($namespace);
        $file_path = $path.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.$group.'.php';
        $file_path = FileService::fixPath($file_path);

        return $file_path;
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public static function add(string $key, array $data) {
        $file_path = self::getFilePath($key);
        $original = [];
        if (File::exists($file_path)) {
            $original = File::getRequire($file_path);
<<<<<<< HEAD
            // $original = Lang::get($key, []);
=======
            //$original = Lang::get($key, []);
>>>>>>> 9472ad4 (first)
        }

        if (! is_array($original)) {
            dddx(
                [
                    'message' => 'original is not an array',
                    'file_path' => $file_path,
                    'original' => $original,
<<<<<<< HEAD
                    // 'ori1' => File::getRequire($file_path),
=======
                    //'ori1' => File::getRequire($file_path),
>>>>>>> 9472ad4 (first)
                    'key' => $key,
                    'data' => $data,
                ]
            );
<<<<<<< HEAD
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }
        $merged = collect($original)
            ->merge($data)
            ->all();
=======
        }
        $merged = collect($original)->merge($data)->all();
>>>>>>> 9472ad4 (first)

        if ($original != $merged) {
            ArrayService::save(['data' => $merged, 'filename' => $file_path]);
            Session::flash('status', 'Modifica Eseguita! ['.$file_path.']');
        }
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public static function addMissing(string $key, array $data) {
        $missing = collect($data)
            ->filter(
                function ($item) use ($key) {
                    $k = $key.'.'.$item;
                    $v = trans($k);

                    return $k == $v;
                }
            )->all();
        $missing = array_combine($missing, $missing);
        self::add($key, $missing);
    }

    public static function getArrayTranslated(string $key, array $data): array {
        TranslatorService::addMissing($key, $data);

        $data = collect($data)->map(
            function ($item) use ($key) {
                $k = $key.'.'.$item;
                $v = trans($k);

                return $v;
            }
        )->all();

        return $data;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9472ad4 (first)
