<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

<<<<<<< HEAD
use Illuminate\Support\Facades\File;
=======
>>>>>>> 04f6c8ba (first)
use Livewire\Livewire;

/**
 * LivewireService.
 */
<<<<<<< HEAD
class LivewireService
{
    /**
     * Undocumented function.
     */
    public static function registerComponents(string $path, string $namespace, string $prefix = ''): void
    {
        $comps = FileService::getComponents($path, $namespace.'\Http\Livewire', $prefix);

=======
class LivewireService {
    /**
     * Undocumented function.
     */
    public static function registerComponents(string $path, string $namespace, string $prefix = ''): void {
        $comps = FileService::getComponents($path, $namespace.'\Http\Livewire', $prefix);
        /*
        if(count($comps)>1){
            dddx([
                'path'=>$path,
                'namespace'=>$namespace,
                'prefix'=>$prefix,
                'comps'=>$comps,
            ]);
        }
        //*/
>>>>>>> 04f6c8ba (first)
        foreach ($comps as $comp) {
            Livewire::component($comp->comp_name, $comp->comp_ns);
        }
    }
}
