<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

use Exception;

<<<<<<< HEAD
// -------- models -----------

// -------- services --------

// -------- bases -----------
=======
//-------- models -----------

//-------- services --------

//-------- bases -----------
>>>>>>> 9472ad4 (first)

/**
 * Class ChunkUpload.
 */
<<<<<<< HEAD
class ChunkUpload extends XotBasePanelAction {
    public bool $onContainer = true; // onlyContainer
=======
class ChunkUpload extends XotBasePanelAction
{
    public bool $onContainer = true; //onlyContainer
>>>>>>> 9472ad4 (first)

    public string $icon = '<i class="fas fa-puzzle-piece"></i>';

    /**
     * @return \Illuminate\Http\JsonResponse
     */
<<<<<<< HEAD
    public function handle() {
=======
    public function handle()
    {
>>>>>>> 9472ad4 (first)
        $filename = $_POST['dir'].\DIRECTORY_SEPARATOR.$_POST['name'];
        $fp_method = 'w';
        if ($_POST['seek'] > 0) {
            $fp_method = 'a';
        }
<<<<<<< HEAD
        $fp = fopen($filename, $fp_method);
=======
        $fp = \fopen($filename, $fp_method);
>>>>>>> 9472ad4 (first)
        if (false === $fp) {
            throw new Exception('can not open '.$filename);
        }

        if ($_POST['seek'] > 0) {
<<<<<<< HEAD
            fseek($fp, $_POST['seek']);
        }
        fwrite($fp, $_POST['chunk']);
        fclose($fp);
        $ris = [
            'filename' => $filename,
            'path' => realpath($filename),
            'seek' => $_POST['seek'],
            // 'chunck' =>  $_POST['chunk'],
=======
            \fseek($fp, $_POST['seek']);
        }
        \fwrite($fp, $_POST['chunk']);
        \fclose($fp);
        $ris = [
            'filename' => $filename,
            'path' => \realpath($filename),
            'seek' => $_POST['seek'],
            //'chunck' =>  $_POST['chunk'],
>>>>>>> 9472ad4 (first)
        ];

        return response()->json($ris);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
<<<<<<< HEAD
    public function postHandle() {
=======
    public function postHandle()
    {
>>>>>>> 9472ad4 (first)
        $filename = $_POST['dir'].\DIRECTORY_SEPARATOR.$_POST['name'];

        $fp_method = 'w';
        if ($_POST['seek'] > 0) {
            $fp_method = 'a';
        }
<<<<<<< HEAD
        $fp = fopen($filename, $fp_method);
=======
        $fp = \fopen($filename, $fp_method);
>>>>>>> 9472ad4 (first)
        if (false === $fp) {
            throw new Exception('can not open '.$filename);
        }

        if ($_POST['seek'] > 0) {
<<<<<<< HEAD
            fseek($fp, $_POST['seek']);
        }

        fwrite($fp, $_POST['chunk']);
        fclose($fp);
        $ris = [
            'filename' => $filename,
            'path' => realpath($filename),
            'seek' => $_POST['seek'],
            // 'chunck' =>  $_POST['chunk'],
=======
            \fseek($fp, $_POST['seek']);
        }

        \fwrite($fp, $_POST['chunk']);
        \fclose($fp);
        $ris = [
            'filename' => $filename,
            'path' => \realpath($filename),
            'seek' => $_POST['seek'],
            //'chunck' =>  $_POST['chunk'],
>>>>>>> 9472ad4 (first)
        ];

        return response()->json($ris);
    }
}
