<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

// -------- models -----------

// -------- services --------

// -------- bases -----------

/**
 * Class ChunkUpload.
 */
class ChunkUpload extends XotBasePanelAction {
    public bool $onContainer = true; // onlyContainer

    public string $icon = '<i class="fas fa-puzzle-piece"></i>';

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle() {
        $filename = $_POST['dir'].\DIRECTORY_SEPARATOR.$_POST['name'];
        $fp_method = 'w';
        if ($_POST['seek'] > 0) {
            $fp_method = 'a';
        }
        $fp = fopen($filename, $fp_method);
        if (false === $fp) {
            throw new \Exception('can not open '.$filename);
        }

        if ($_POST['seek'] > 0) {
            fseek($fp, $_POST['seek']);
        }
        fwrite($fp, $_POST['chunk']);
        fclose($fp);
        $ris = [
            'filename' => $filename,
            'path' => realpath($filename),
            'seek' => $_POST['seek'],
            // 'chunck' =>  $_POST['chunk'],
        ];

        return response()->json($ris);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function postHandle() {
        $filename = $_POST['dir'].\DIRECTORY_SEPARATOR.$_POST['name'];

        $fp_method = 'w';
        if ($_POST['seek'] > 0) {
            $fp_method = 'a';
        }
        $fp = fopen($filename, $fp_method);
        if (false === $fp) {
            throw new \Exception('can not open '.$filename);
        }

        if ($_POST['seek'] > 0) {
            fseek($fp, $_POST['seek']);
        }

        fwrite($fp, $_POST['chunk']);
        fclose($fp);
        $ris = [
            'filename' => $filename,
            'path' => realpath($filename),
            'seek' => $_POST['seek'],
            // 'chunck' =>  $_POST['chunk'],
        ];

        return response()->json($ris);
    }
}
