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
    private \Intervention\Image\Image $img;
    protected int $width;
    protected int $height;
    protected string $src;
    protected string $dirname;
    protected string $filename;

    private static ?self $instance = null;

    public static function getInstance(): self {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function make(): self {
        return static::getInstance();
    }

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

    public function fit(): self {
        $this->img->fit($this->width, $this->height);

        return $this;
    }

    public function save(): self {
        $info = pathinfo($this->src);
        if (! isset($info['extension'])) {
            $info['extension'] = 'jpg';
        }

        $basename = Str::slug($info['filename']).'.'.$info['extension'];

        $this->filename = $this->dirname.'/'.$this->width.'x'.$this->height.'/'.$basename;

        try {
            Storage::disk('photos')->put($this->filename, $this->out());
        } catch (Exception $e) {//ftp_mkdir(): Can't create directory: File exists
             //$r = $this->img->save(self::$filename, 75);
        }

        return $this;
    }

    public function url(): string {
        return Storage::disk('photos')->url($this->filename);
    }
}
