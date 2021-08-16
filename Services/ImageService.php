<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Cache;
use Exception;
use Illuminate\Support\Str;
use ImageOptimizer;
use Intervention\Image\Facades\Image;

//---- services ----

/**
 * Class ImageService.
 */
class ImageService {
    private static ?ImageService $instance = null;

    /**
     * @var mixed
     */
    protected static $img = null;

    protected static int $width;

    protected static int $height;

    protected static string $src;

    protected static string $filename;

    protected static string $dirname = '/imgz';

    /**
     * @return ImageService|null
     */
    public static function getInstance(array $params = []) {
        if (null === self::$instance) {
            self::$instance = new self($params);
        }

        return self::$instance;
    }

    /**
     * ImageService constructor.
     */
    public function __construct(array $params = []) {
        $this->init($params);
    }

    //---- setter

    /**
     * @param array $params
     */
    public static function init($params): void {
        //dddx($params);
        //$instance == self::getInstance();
        foreach ($params as $k => $v) {
            $func = 'set'.Str::studly((string) $k);
            if (null == $v) {
                $v = '';
            }
            //if (method_exists($instance, $func)) {
            self::$func($v);
            //} else {
            //    self::$k = $v;
           // }
        }
        //return self::getInstance();
    }

    public static function setDirname(string $dirname): void {
        self::$dirname = $dirname;
    }

    public static function setImg(string $val): void {
        $nophoto_path = public_path('img/nophoto.jpg');
        if ('' == $val) {
            $val = $nophoto_path;
        }
        if (Str::startsWith($val, '//')) {
            $val = 'http:'.$val;
        }
        if (Str::startsWith($val, '/photos/')) {
            $val = public_path($val);
        }
        try {
            self::$img = Image::make($val);
        } catch (\Exception $e) {
            self::$img = Image::make($nophoto_path);
        }
    }

    public static function setWxh(string $val): void {
        list($w, $h) = \explode('x', $val);
        self::setWidth((int) $w);
        self::setHeight((int) $h);
    }

    public static function setWidth(int $val): void {
        self::$width = $val;
    }

    public static function setHeight(int $val): void {
        self::$height = $val;
    }

    public static function setSrc(string $val): void {
        if ('' == $val) {
            $val = public_path('img/nophoto.jpg');
        }
        if (Str::startsWith($val, url(''))) { //se e' una immagine locale
            $val = public_path(\substr($val, strlen(url(''))));
        }
        $str = '/laravel-filemanager/';
        if (Str::startsWith($val, $str)) {
            $val = public_path(\substr($val, strlen($str)));
        }
        self::$src = $val;
        self::setImg($val);
    }

    //----------

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public static function toHtml() {
    }

    /**
     * @param array $params
     *
     * @return mixed
     */
    public static function image_resized_cropped($params) {
        $width = self::$width;
        $height = self::$height;
        \extract($params);
        if (! isset($image_path)) {
            dddx(['err' => 'image_path is missing']);

            return;
        }
        $pathinfo = \pathinfo($image_path);
        //$image_resized='assets_packs/img/'.$width.'x'.$height.'/'.basename($image_path);
        if (null == $image_path) {
            return 'assets_packs/img/'.$width.'x'.$height.'/nophoto.png';
        }
        $image_resized = 'assets_packs/img/'.$width.'x'.$height.'/'.$pathinfo['filename'].'.jpg';
        if (\File::exists(public_path($image_resized))) {
            return $image_resized;
        } //immagine la creo 1 volta sola
        if ('//' == \mb_substr($image_path, 0, 2)) {
            $image_path = 'http:'.$image_path;
        }

        if (! \File::exists($image_path)) {
            //return false;
        }

        $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
        $allowedExtensions = ['jpg', 'png', 'gif'];
        if (! isset($pathinfo['extension'])) {
            return $image_path;
        }
        if (! \in_array($pathinfo['extension'], $allowedExtensions, true)) {
            return $image_path;
        }
        //if(!in_array($contentType,$allowedMimeTypes)) return $image_path;

        //return $image_path;

        $img = Image::make($image_path);

        $img->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        if ($img->height() > $height) {
            /* //voglio croppare l'immagine per non lasciare bordi brutti
            $img->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            */
            $x0 = 0;
            $y0 = \rand(0, $img->height() - $height);
            $img->crop($width, $height, $x0, $y0);
        }
        $w0 = $img->width();
        $h0 = $img->height();
        $canvas = Image::canvas($width, $height, '#fdfdfd');
        $x = \round(($width - $w0) / 2, 0);
        $y = \round(($height - $h0) / 2, 0);
        $canvas->insert($img, 'top-left', (int) $x, (int) $y);

        \File::makeDirectory(\dirname(public_path($image_resized)), 0775, true, true);
        $canvas->save(public_path($image_resized), 75);
        //ImageOptimizer::optimize(public_path($image_resized));
        //app(Spatie\ImageOptimizer\OptimizerChain::class)->optimize(public_path($image_resized));
        return $image_resized;
    }

    //Method Modules\Xot\Services\ImageService::fit()
    //should return Modules\Xot\Services\ImageService
    //but returns Modules\Xot\Services\ImageService|null.
    public static function fit(array $params = []): self {
        $me = self::getInstance($params);

        $img = self::$img;
        $width = self::$width;
        $height = self::$height;

        self::$img->fit($width, $height);

        //return self::getInstance();
        if (null == $me) {
            throw new Exception('something gone wrong');
        }

        return $me;
    }

    public static function crop(array $params = []): self {
        $me = self::getInstance($params);

        $img = self::$img;
        $width = self::$width;
        $height = self::$height;

        if ($width > $height) {
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            if ($img->height() > $height) {
                /* //voglio croppare l'immagine per non lasciare bordi brutti
                    $img->resize(null, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                */
                $x0 = 0;
                //$y0 = \rand(0, $img->height() - $height);
                $y0 = round(($img->height() + $height) / 2, 0);
                $img->crop($width, $height, $x0, $y0);
            }
        } else {
            $img->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            });

            if ($img->width() > $width) {
                /* //voglio croppare l'immagine per non lasciare bordi brutti
                    $img->resize(null, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                */
                //$x0 = \rand(0, $img->width() - $width);
                $x0 = round(($img->width() + $width) / 2, 0);
                $y0 = 0;
                $img->crop($width, $height, $x0, $y0);
            }
        }
        $w0 = $img->width();
        $h0 = $img->height();
        $canvas = Image::canvas($width, $height, '#fdfdfd');
        $x = \round(($width - $w0) / 2, 0);
        $y = \round(($height - $h0) / 2, 0);
        $canvas->insert($img, 'top-left', (int) $x, (int) $y);
        self::$img = $canvas;

        //return self::getInstance();
        if (null == $me) {
            throw new Exception('something gone wrong');
        }

        return $me;
        /// per il fluent, o chaining
    }

    public static function save(array $params = []): self {
        //extract($params);
        $info = pathinfo(self::$src);
        //dddx($info);
        /*
        $basename = basename(self::$src);
        $basename = Str::before($basename, '?');
        $basename = Str::slug($basename);
        */
        if (! isset($info['extension'])) {
            $info['extension'] = 'jpg';
        }

        $basename = Str::slug($info['filename']).'.'.$info['extension'];
        //self::$filename = public_path(self::$dirname.'/'.self::$width.'x'.self::$height.'/'.$basename);
        //\File::makeDirectory(\dirname(self::$filename), 0775, true, true);

        self::$filename = self::$dirname.'/'.self::$width.'x'.self::$height.'/'.$basename;
        try {
            \Storage::disk('infinityfree')->put(self::$filename, self::out());
            //$r = self::$img->save(self::$filename, 75);
        } catch (\Exception $e) {
        }

        $me = self::getInstance();
        //return self::getInstance();
        if (null == $me) {
            throw new Exception('something gone wrong');
        }

        return $me;
    }

    /**
     * @return mixed
     */
    public static function out(array $params = []) {
        return self::$img->encode('jpg', 60);
    }

    /**
     * @return string|string[]
     */
    public static function src(array $params = []) {
        $src = '/'.str_replace(public_path('/'), '', self::$filename);
        $src = str_replace('//', '/', $src);

        //come faccio a recuperare l'url dell'immagine dal cdn?
        //forse non mettere mani qui ma in themeservice->asset(), cioè in FileService->asset()?
        //perchè è giusto che nel db si salvi url relativo?
        //dddx($src);
        //dddx(\Storage::disk('infinityfree')->get($src));

        return $src;
    }

    /**
     * @param array $params
     *
     * @return string|void|null
     */
    public static function image_resized_canvas($params) {
        $width = self::$width;
        $height = self::$height;
        \extract($params);
        if (! isset($image_path)) {
            dddx(['err' => 'image_path is missing']);

            return;
        }
        $pathinfo = \pathinfo($image_path);
        //$image_resized='assets_packs/img/'.$width.'x'.$height.'/'.basename($image_path);
        if (null == $image_path) {
            //return 'assets_packs/img/'.$width.'x'.$height.'/nophoto.png';
            $image_path = public_path('images/nophoto.png');
        }
        $image_resized = 'assets_packs/img/'.$width.'x'.$height.'/'.$pathinfo['filename'].'.jpg';
        //if(\File::exists(public_path($image_resized))) return $image_resized; //immagine la creo 1 volta sola
        if ('//' == \mb_substr($image_path, 0, 2)) {
            $image_path = 'http:'.$image_path;
        }
        $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
        $allowedExtensions = ['jpg', 'png', 'gif'];
        if (! isset($pathinfo['extension'])) {
            $pathinfo['extension'] = '';
        }
        $pos = \mb_strpos($pathinfo['extension'], '&');
        if (false !== $pos) {
            $pathinfo['extension'] = \mb_substr($pathinfo['extension'], 0, $pos);
        }

        if (! isset($pathinfo['extension'])) {
            return $image_path;
        }
        if (! \in_array($pathinfo['extension'], $allowedExtensions, true)) {
            return $image_path;
        }
        //if(!in_array($contentType,$allowedMimeTypes)) return $image_path;
        //* -- spostato in importtrait
        $str0 = 'https://s2.qwant.com'; //questo fa un redirect
        $str1 = 'http://s2.qwant.com';
        $str2 = 'https://s2.qwant.com'; //questo fa un redirect
        $str3 = 'http://s2.qwant.com';
        if (\mb_substr($image_path, 0, \mb_strlen($str0)) == $str0 || \mb_substr($image_path, 0, \mb_strlen($str1)) == $str1 ||
           \mb_substr($image_path, 0, \mb_strlen($str2)) == $str2 || \mb_substr($image_path, 0, \mb_strlen($str3)) == $str3) {
            $pos = \mb_strpos($image_path, '?');
            $image_path1 = \mb_substr($image_path, $pos + 1);
            \parse_str($image_path1, $output);
            //echo '<h3>'.$image_path1.'</h3>';
            $image_path = \urldecode($output['u']);
        }
        //*/
        $str = '/laravel-filemanager/';
        if (\mb_substr($image_path, 0, \mb_strlen($str)) == $str) {
            $image_path = public_path(\mb_substr($image_path, \mb_strlen($str)));
            //die($image_path);
        }
        if (Str::startsWith($image_path, '/')) {
            if (! Str::startsWith($image_path, public_path('/'))) {
                $image_path = public_path($image_path);
            }
        }
        //die($image_path);

        //return $image_path;
        try {
            $img = Image::make($image_path);
        } catch (\Intervention\Image\Exception\NotReadableException $e) {
            $filename = Str::slug(\basename($image_path)).'.'.$pathinfo['extension'];
            /*
            if(!\Storage::disk('cache')->exists($filename)){
                \Storage::disk('cache')->put($filename, fopen($image_path, 'r'));
            }

            */
            //$asset = new FileAsset();

            //$jpg=imagecreatefromjpeg($image_path);

            //die('['.__LINE__.']['.__FILE__.']');
            $img_content = ImportService::cacheRequestFile('GET', $image_path);
            \Storage::disk('cache')->put($filename, $img_content);
            try {
                $img = Image::make(\Storage::disk('cache')->path($filename));
            } catch (\Intervention\Image\Exception\NotReadableException $e) {
                //echo '<h3>['.__LINE__.']['.__FILE__.']</h3>';
                //$this->image_src=''; //-- meglio non cancellare..
                //$this->image_resize_src=[];
                //$this->save();
                //ddd('non dovrei essere qui');
                return null;
            }
            //$img_content=base64_encode($img_content);
            //$im = imagecreatefromstring($img_content);

            //$img=Image::make($img_content);
            //*
            //echo '<h3>['.__LINE__.']['.__FILE__.']</h3>';
            //return ;
            //echo $content;

            //*/
        }

        $img->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        if ($img->height() > $height) {
            $img->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $w0 = $img->width();
        $h0 = $img->height();
        $canvas = Image::canvas($width, $height, '#fdfdfd');
        $x = \round(($width - $w0) / 2, 0);
        $y = \round(($height - $h0) / 2, 0);
        $canvas->insert($img, 'top-left', (int) $x, (int) $y);

        \File::makeDirectory(\dirname(public_path($image_resized)), 0775, true, true);
        $canvas->save(public_path($image_resized), 75);
        //ImageOptimizer::optimize(public_path($image_resized));   //--- CAPIRE SE NE VALE LA PENA
        //app(Spatie\ImageOptimizer\OptimizerChain::class)->optimize(public_path($image_resized));
        return $image_resized;
    }
}
