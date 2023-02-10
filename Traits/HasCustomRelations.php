<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

/*
 * https://stackoverflow.com/questions/39213022/custom-laravel-relations
 * https://github.com/johnnyfreeman/laravel-custom-relation
 */

use Modules\Xot\Relations\CustomRelation;

// use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasCustomRelations.
 */
trait HasCustomRelations {
    /**
     * @return CustomRelation
     */
    public function customRelation($related, \Closure $baseConstraints, \Closure $eagerConstraints = null, \Closure $eagerMatcher = null) {
        $instance = new $related();
        $query = $instance->newQuery();

        return new CustomRelation($query, $this, $baseConstraints, $eagerConstraints, $eagerMatcher);
    }
}
