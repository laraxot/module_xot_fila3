<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * BladeService.
 */
class BladeService {
    /**
     * Undocumented function.
     */
    public static function registerComponents(string $path, string $namespace): void {
        //$components_json = $this->dir.'/../View/Components/_components.json';
        $components_json = $path.'/_components.json';

        $exists = File::exists($components_json);
        if ($exists && false) {
            $content = File::get($components_json);
            $comps = json_decode($content);
        } else {
            $files = File::allFiles(dirname($components_json));

            $comps = [];
            foreach ($files as $k => $v) {
                if ('php' == $v->getExtension()) {
                    $tmp = (object) [];
                    $class_name = $v->getFilenameWithoutExtension();

                    $tmp->class_name = $class_name;

                    //$tmp->comp_name = $this->ns.'::'.Str::snake(Str::replace('\\', ' ', $class_name));
                    $tmp->comp_name = Str::slug(Str::snake(Str::replace('\\', ' ', $class_name)));

                    $tmp->comp_ns = $namespace.'\View\Components\\'.$class_name;

                    if ('' != $v->getRelativePath()) {
                        //$tmp->comp_name = $this->module_name.'::';
                        $tmp->comp_name = '';
                        $piece = collect(explode('\\', $v->getRelativePath()))
                            ->map(
                                function ($item) {
                                    return Str::slug(Str::snake($item));
                                }
                            )
                            ->implode('.');
                        $tmp->comp_name .= $piece;
                        $tmp->comp_name .= '.'.Str::slug(Str::snake(Str::replace('\\', ' ', $class_name)));
                        $tmp->comp_ns = $namespace.'\View\Components\\'.$v->getRelativePath().'\\'.$class_name;
                        $tmp->class_name = $v->getRelativePath().'\\'.$tmp->class_name;
                    }

                    $comps[] = $tmp;
                }
            }
            //dddx(['comps' => $comps]);

            $content = json_encode($comps);
            if (false === $content) {
                throw new \Exception('can not decode json');
            }
            $old_content = '';
            if (File::exists($components_json)) {
                $old_content = File::get($components_json);
            }
            if ($old_content != $content) {
                File::put($components_json, $content);
            }
        }

        foreach ($comps as $comp) {
            Blade::component($comp->comp_name, $comp->comp_ns);
        }
    }
}
