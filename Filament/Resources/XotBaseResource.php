<?php

/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources;

use Filament\Resources\Resource;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;

abstract class XotBaseResource extends Resource
{
    protected static ?string $model = null;

    // protected static ?string $navigationIcon = 'heroicon-o-bell';
    // protected static ?string $navigationLabel = 'Custom Navigation Label';
    // protected static ?string $activeNavigationIcon = 'heroicon-s-document-text';
    // protected static bool $shouldRegisterNavigation = false;
    // protected static ?string $navigationGroup = 'Parametri di Sistema';
    protected static ?int $navigationSort = 3;

    public static function getModuleName(): string
    {
        return Str::between(static::class, 'Modules\\', '\Filament');
    }

    public static function transPath(string $key): string
    {
        $moduleNameLow = Str::lower(static::getModuleName());
        // $modelClass = static::$model ?? static::getModel();
        $modelClass = static::getModel();
        Assert::notNull($modelClass);
        $modelNameSlug = Str::kebab(class_basename($modelClass));
        $res = $moduleNameLow.'::'.$modelNameSlug.'.'.$key;

        return $res;
    }

    public static function trans(string $key): string
    {
        $res = __(static::transPath($key));
        if (is_array($res)) {
            throw new \Exception('fix lang ['.$key.']');
        }

        return $res;
    }

    public static function getModel(): string
    {
        // if (null != static::$model) {
        //    return static::$model;
        // }
        $moduleName = static::getModuleName();
        $modelName = Str::before(class_basename(static::class), 'Resource');
        $res = 'Modules\\'.$moduleName.'\Models\\'.$modelName;
        static::$model = $res;

        return $res;
    }

    public static function getModelLabel(): string
    {
        return static::trans('navigation.name');
    }

    public static function getPluralModelLabel(): string
    {
        // return static::transPath('navigation.plural');
        return static::trans('navigation.plural');
    }

    public static function getNavigationLabel(): string
    {
        // return static::trans('navigation.name');
        return static::trans('navigation.plural');
    }

    public static function getNavigationGroup(): string
    {
        return static::trans('navigation.group.name');
    }

    public static function getPluralLabel(): string
    {
        return static::trans('navigation.plural');
    }

    public static function getLabel(): string
    {
        return static::trans('navigation.name');
    }

    protected function getTitle(): string
    {
        return static::trans('navigation.name');
    }

    // public static function getNavigationIcon(): ?string
    // {
    //    return 'heroicon-o-user-group';
    // }

    // public static function getNavigationSort(): ?int
    // {
    //    return 2;
    // }

    public static function extendTableCallback(): array
    {
        return [
        ];
    }

    public static function extendFormCallback(): array
    {
        return [
        ];
    }
}
