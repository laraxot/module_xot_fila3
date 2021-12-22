<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Collective\Html\FormFacade as Form;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * CollectiveService.
 */
class CollectiveService {
    /**
     * Undocumented function.
     */
    public static function getComponents(string $view_path, string $namespace, string $prefix, bool $force_recreate = false): array {
        //$view_path = realpath(__DIR__.'/../Resources/views/collective/fields');

        $components_json = $view_path.'/_components.json';
        $components_json = str_replace(['/', '\\'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $components_json);

        $exists = File::exists($components_json);
        if ($exists && ! $force_recreate) {
            $content = File::get($components_json);
            $json = json_decode($content);

            if(empty($json)){
                return [];
            }
            return $json;
        }

        $comps = [];

        if (! $view_path) {
            throw new \Exception('$view_path is false');
        }

        $dirs = FileService::allDirectories($view_path, ['css', 'js']);
        $comps = collect($dirs)->map(
            function ($item) use ($prefix) {
                $ris = new \StdClass();
                $tmp = str_replace(DIRECTORY_SEPARATOR, ' ', $item);
                $tmp_dot = str_replace(DIRECTORY_SEPARATOR, '.', $item);
                $ris->name = 'bs'.Str::studly($tmp);
                $ris->view = $prefix.'collective.fields.'.$tmp_dot.'.field';

                return $ris;
            }
        )->all();

        $content = json_encode($comps);
        if (! $content) {
            throw new \Exception('$content is false');
        }
        File::put($components_json, $content);

        return $comps;
    }

    public static function registerComponents(string $path = '', string $namespace = '', string $prefix = ''): void {
        $comps = self::getComponents($path, $namespace, $prefix, true);

        $blade_component = 'components.blade.input';
        if (inAdmin()) {
            $blade_component = 'adm_theme::layouts.'.$blade_component;
        } else {
            $blade_component = 'pub_theme::layouts.'.$blade_component;
        }

        foreach ($comps as $comp) {
            Form::component(
                $comp->name,
                $comp->view,
                ['name', 'value' => null, 'attributes' => [],
                    'options' => [],
                    'comp_view' => $comp->view,
                    //'comp_dir' => realpath($comp->dir),
                    'comp_ns' => implode('.', array_slice(explode('.', $comp->view), 0, -1)),
                    'blade_component' => $blade_component, ]
            );
        }//end foreach
    }

    //end function

    public static function registerMacros(string $macros_dir): void {
        //$macros_dir = __DIR__.'/../Macros';
        Collection::make(glob($macros_dir.'/*.php'))
            ->mapWithKeys(function ($path) {
                return [$path => pathinfo($path, PATHINFO_FILENAME)];
            })
            ->reject(function ($macro) {
                return Collection::hasMacro($macro);
            })
            ->each(function ($macro, $path): void {
                $class = '\\Modules\\FormX\\Macros\\'.$macro;
                if ('BaseFormBtnMacro' != $macro) {
                    Form::macro('bs'.Str::studly($macro), app($class)());
                }
            });
    }

    //end function
}