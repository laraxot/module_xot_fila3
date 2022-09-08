<?php

/**
<<<<<<< HEAD
=======
 * 
>>>>>>> 9472ad4 (first)
 * da guardare
 * https://github.com/themsaid/laravel-langman.
 * https://blog.quickadminpanel.com/10-best-laravel-packages-for-multi-language-translations/.
 * https://translation.io/laravel/usage.
 */

declare(strict_types=1);

namespace Modules\Xot\Services;

<<<<<<< HEAD
class TranslateService {
=======
class TranslateService
{
>>>>>>> 9472ad4 (first)
    /**
     * Undocumented function
     * https://mymemory.translated.net/doc/spec.php.
     */
<<<<<<< HEAD
    public function myMemory(string $q, string $from, string $to): string {
        // https://api.mymemory.translated.net/get?q=Hello World!&langpair=en|it
=======
    public function myMemory(string $q, string $from, string $to): string
    {
        //https://api.mymemory.translated.net/get?q=Hello World!&langpair=en|it
>>>>>>> 9472ad4 (first)
        return '';
    }

    /**
     * Undocumented function
     * https://www.deepl.com/app/.
     * https://github.com/chriskonnertz/DeepLy.
     * https://github.com/JorisvanW/deepl-laravel.
     * https://github.com/SC-Networks/deepl-api-connector.
     */
<<<<<<< HEAD
    public function deepL(string $q, string $from, string $to): string {
        return '';
    }

    public static function apertiumTrans(string $q, string $from, string $to): string {
        // https://github.com/24aitor/Laralang/blob/master/src/Builder/ApertiumTrans.php
        // $host = 'api.apertium.org';
        // $urldata = file_get_contents("http://$host/json/translate?q=$urlString&langpair=$this->from|$this->to");
        // $data = json_decode($urldata, true);
=======
    public function deepL(string $q, string $from, string $to): string
    {
        return '';
    }

    public static function apertiumTrans(string $q, string $from, string $to): string
    {
        //https://github.com/24aitor/Laralang/blob/master/src/Builder/ApertiumTrans.php
        //$host = 'api.apertium.org';
        //$urldata = file_get_contents("http://$host/json/translate?q=$urlString&langpair=$this->from|$this->to");
        //$data = json_decode($urldata, true);
>>>>>>> 9472ad4 (first)
        return '';
    }

    /**
     * stichoza/google-translate-php.
     * https://github.com/24aitor/Laralang/blob/master/src/Builder/GoogleTrans.php.
     */
<<<<<<< HEAD
    public static function googleTrans(string $q, string $from, string $to): string {
        $host = 'translate.googleapis.com';
        $q = urlencode($q);
        $urldata = file_get_contents("https://translate.googleapis.com/translate_a/single?client=gtx&sl=$from&tl=$to&dt=t&q=$q");
        $tr = (string) $urldata;
        $tr = mb_substr($tr, 3, -6);
        $tr = $tr.'["';
        $tr = explode('],[', $tr);
        $trans = [];
        foreach ($tr as $tran) {
            $transl = explode('","', $tran);
            $trans[] = str_replace('\"', '"', ucfirst(mb_substr($transl[0], 1)));
        }

        return trim(implode(' ', $trans));
=======
    public static function googleTrans(string $q, string $from, string $to): string
    {
        $host = 'translate.googleapis.com';
        $q = \urlencode($q);
        $urldata = \file_get_contents("https://translate.googleapis.com/translate_a/single?client=gtx&sl=$from&tl=$to&dt=t&q=$q");
        $tr = (string) $urldata;
        $tr = \mb_substr($tr, 3, -6);
        $tr = $tr.'["';
        $tr = \explode('],[', $tr);
        $trans = [];
        foreach ($tr as $tran) {
            $transl = \explode('","', $tran);
            \array_push($trans, \str_replace('\"', '"', \ucfirst(\mb_substr($transl[0], 1))));
        }

        return \trim(\implode(' ', $trans));
>>>>>>> 9472ad4 (first)
    }

    /**
     * Undocumented function
     * https://platform.systran.net/reference/translation#resource_Translation.
     */
<<<<<<< HEAD
    public static function systran(string $q, string $from, string $to): string {
=======
    public static function systran(string $q, string $from, string $to): string
    {
>>>>>>> 9472ad4 (first)
        return '';
    }
}
