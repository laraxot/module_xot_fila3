<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

<<<<<<< HEAD
// use File;
// ---- services --
=======
//use File;
//---- services --
>>>>>>> 9472ad4 (first)

/**
 * Class ImageController.
 */
<<<<<<< HEAD
class ImageController extends Controller {
    public function index(Request $request): void {
=======
class ImageController extends Controller
{
    public function index(Request $request): void
    {
>>>>>>> 9472ad4 (first)
        dddx('index');
    }

    /**
     * @return mixed
     */
<<<<<<< HEAD
    public function show(Request $request) {
        //$params = optional(\Route::current())->parameters();
        $params = getRouteParameters();
=======
    public function show(Request $request)
    {
        $params = optional(\Route::current())->parameters();
>>>>>>> 9472ad4 (first)
        list($containers, $items) = params2ContainerItem($params);
        $last_item = last($items);

        return $this->$last_item($request);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
<<<<<<< HEAD
    public function store(Request $request) {
=======
    public function store(Request $request)
    {
>>>>>>> 9472ad4 (first)
        return $this->canvas($request);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
<<<<<<< HEAD
    public function canvas(Request $request) {
        $data = $request->all();
        $path_parts = pathinfo($data['name']);
=======
    public function canvas(Request $request)
    {
        $data = $request->all();
        $path_parts = \pathinfo($data['name']);
>>>>>>> 9472ad4 (first)
        $error = false;

        $absolutedir = __DIR__;
        $dir = '/tmp/';
        $serverdir = $absolutedir.$dir;

<<<<<<< HEAD
        $tmp = explode(',', $data['data']);
        $imgdata = base64_decode($tmp[1], true);
        if (false == $imgdata) {
            throw new \Exception('cannot decode imgdata base64');
        }

        // $extension              = strtolower(end(explode('.',$data['name'])));
        $extension = $path_parts['extension'] ?? '';
        $filename = mb_substr($data['name'], 0, -(mb_strlen($extension) + 1)).'.'.mb_substr(sha1(time().''), 0, 6).'.'.$extension;
=======
        $tmp = \explode(',', $data['data']);
        $imgdata = \base64_decode($tmp[1], true);
        if (null == $imgdata) {
            throw new \Exception('cannot decode imgdata base64');
        }

        //$extension              = strtolower(end(explode('.',$data['name'])));
        $extension = $path_parts['extension'] ?? '';
        $filename = \mb_substr($data['name'], 0, -(\mb_strlen($extension) + 1)).'.'.\mb_substr(\sha1(\time().''), 0, 6).'.'.$extension;
>>>>>>> 9472ad4 (first)
        /*
        $handle                 = fopen($serverdir.$filename,'w');

        fwrite($handle, $imgdata);
        fclose($handle);
        */
        $path = 'photos/'.\Auth::id().'/'.$filename;
        \Storage::disk('public_html')->put($path, $imgdata);
        $url = \Storage::disk('public_html')->url($path);
<<<<<<< HEAD
        $url = str_replace(url('/'), '', $url); // per risparmiare spazio

        $str = '/storage';
        if (Str::startsWith($url, $str)) {
            $url = substr($url, \strlen($str));
=======
        $url = \str_replace(url('/'), '', $url); //per risparmiare spazio

        $str = '/storage';
        if (Str::startsWith($url, $str)) {
            $url = substr($url, strlen($str));
>>>>>>> 9472ad4 (first)
        }

        $response = [
            'status' => 'success',
<<<<<<< HEAD
            'url' => $url.'?'.time(), // added the time to force update when editting multiple times
=======
            'url' => $url.'?'.\time(), //added the time to force update when editting multiple times
>>>>>>> 9472ad4 (first)
            'filename' => $filename,
        ];

        if (! empty($data['original'])) {
<<<<<<< HEAD
            $tmp = explode(',', $data['original']);
            $originaldata = base64_decode($tmp[1], true);
            $original = mb_substr($data['name'], 0, -(mb_strlen($extension) + 1)).'.'.mb_substr(sha1(time().''), 0, 6).'.original.'.$extension;

            $handle = fopen($serverdir.$original, 'w');
            if (false !== $handle && false !== $originaldata) {
                fwrite($handle, $originaldata);
                fclose($handle);
=======
            $tmp = \explode(',', $data['original']);
            $originaldata = \base64_decode($tmp[1], true);
            $original = \mb_substr($data['name'], 0, -(\mb_strlen($extension) + 1)).'.'.\mb_substr(\sha1(\time().''), 0, 6).'.original.'.$extension;

            $handle = \fopen($serverdir.$original, 'w');
            if (false != $handle && false != $originaldata) {
                \fwrite($handle, $originaldata);
                \fclose($handle);
>>>>>>> 9472ad4 (first)
            }

            $response['original'] = $original;
        }

        return response()->json($response);
<<<<<<< HEAD
        // print json_encode($response);
    }
}
=======
        //print json_encode($response);
    }
}
>>>>>>> 9472ad4 (first)
