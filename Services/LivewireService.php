<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Livewire\Livewire;

/**
 * LivewireService.
 */
class LivewireService {
    /**
     * Undocumented function.
     */
    public static function registerComponents(string $path, string $namespace, string $prefix = ''): void {
        try {
            $comps = FileService::getComponents($path, $namespace.'\Http\Livewire', $prefix);
        }catch(\Exception $e){
            dddx($comps);
        }
            
        foreach ($comps as $comp) {
            Livewire::component($comp->comp_name, $comp->comp_ns);
        }
    }
}