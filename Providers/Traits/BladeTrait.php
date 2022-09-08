<?php

declare(strict_types=1);

namespace Modules\Xot\Providers\Traits;

use Illuminate\View\Compilers\BladeCompiler;

<<<<<<< HEAD
trait BladeTrait {
=======
trait BladeTrait
{
>>>>>>> 9472ad4 (first)
    /**
     * Register Blade directives.
     *
     * @return void
     */
<<<<<<< HEAD
    protected function registerBladeDirectives() {
=======
    protected function registerBladeDirectives()
    {
>>>>>>> 9472ad4 (first)
        $this->app->afterResolving(
            'blade.compiler',
            function (BladeCompiler $bladeCompiler) {
                dddx(['bladeCompiler' => $bladeCompiler]);
            }
        );
    }

<<<<<<< HEAD
    // end registerBladeDirectives
=======
    //end registerBladeDirectives
>>>>>>> 9472ad4 (first)
}
