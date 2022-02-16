<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

//---- services ----

/**
 * Class ImageService.
 */
class ImageService {
    protected \Intervention\Image\Image $img;
    protected int $width;
    protected int $height;
    protected string $src;
    protected string $dirname;
    protected string $filename;

    private static ?self $_instance = null;

    /**
     * Undocumented function.
     */
    public static function getInstance(): self {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Undocumented function.
     */
    public static function make(): self {
        return static::getInstance();
    }

    /**
     * Undocumented function.
     */
    public function setVars(array $params): self {
        foreach ($params as $k => $v) {
            $func = 'set'.Str::studly((string) $k);
            if (null == $v) {
                $v = '';
            }
            $this->{$func}($v);
        }

        return $this;
    }

    /**
     * Undocumented function.
     */
    public function setImg(string $val): self {
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
            $this->img = Image::make($val);
        } catch (Exception $e) {
            $this->img = Image::make($nophoto_path);
        }

        return $this;
    }

    /**
     * Undocumented function.
     */
    public function fit(): self {
        $this->img->fit($this->width, $this->height);

        return $this;
    }

    /**
     * Undocumented function.
     */
    public function save(): self {
        $info = pathinfo($this->src);
        if (! isset($info['extension'])) {
            $info['extension'] = 'jpg';
        }

        $basename = Str::slug($info['filename']).'.'.$info['extension'];

        $this->filename = $this->dirname.'/'.$this->width.'x'.$this->height.'/'.$basename;

        try {
            //Storage::disk('photos')->put($this->filename, $this->out());
            $this->img->save($this->filename);
        } catch (Exception $e) {//ftp_mkdir(): Can't create directory: File exists
             //$r = $this->img->save(self::$filename, 75);
        }

        return $this;
    }

    /**
     * Undocumented function.
     */
    public function url(): string {
        return Storage::disk('photos')->url($this->filename);
    }

    /**
     * Undocumented function.
     */
    public function out(array $params = []): \Intervention\Image\Image {
        return $this->img->encode('jpg', 60);
    }

    /**
     * Undocumented function.
     */
    public function src(): string {
        $src = '/'.str_replace(public_path('/'), '', $this->filename);
        $src = str_replace('//', '/', $src);

        return $src;
    }

    /**
     * Undocumented function.
     */
    public function setWidth(int $val): self {
        $this->width = $val;

        return $this;
    }

    /**
     * Undocumented function.
     */
    public function setHeight(int $val): self {
        $this->height = $val;

        return $this;
    }

    /**
     * Undocumented function.
     */
    public function setDirname(string $dirname): self {
        $this->dirname = $dirname;

        return $this;
    }
}