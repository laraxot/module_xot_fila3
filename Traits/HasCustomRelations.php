<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

/*
 * https://stackoverflow.com/questions/39213022/custom-laravel-relations
 * https://github.com/johnnyfreeman/laravel-custom-relation
 */

use Closure;
use Modules\Xot\Relations\CustomRelation;

<<<<<<< HEAD
// use Illuminate\Database\Eloquent\Builder;
=======
//use Illuminate\Database\Eloquent\Builder;
>>>>>>> 9472ad4 (first)

/**
 * Trait HasCustomRelations.
 */
<<<<<<< HEAD
trait HasCustomRelations {
=======
trait HasCustomRelations
{
>>>>>>> 9472ad4 (first)
    /**
     * @param $related
     *
     * @return CustomRelation
     */
<<<<<<< HEAD
    public function customRelation($related, Closure $baseConstraints, Closure $eagerConstraints = null, Closure $eagerMatcher = null) {
=======
    public function customRelation($related, Closure $baseConstraints, Closure $eagerConstraints = null, Closure $eagerMatcher = null)
    {
>>>>>>> 9472ad4 (first)
        $instance = new $related();
        $query = $instance->newQuery();

        return new CustomRelation($query, $this, $baseConstraints, $eagerConstraints, $eagerMatcher);
    }
}
