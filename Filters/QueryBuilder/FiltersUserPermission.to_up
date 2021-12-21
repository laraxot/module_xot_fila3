<?php

declare(strict_types=1);

namespace Modules\Xot\Filters\QueryBuilder;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FiltersUserPermission implements Filter {
    public function __invoke(Builder $query, $value, string $property): void {
        $query->whereHas('permissions', function (Builder $query) use ($value): void {
            $query->where('name', $value);
        });
    }
}

// In your controller for the following request:
// GET /users?filter[permission]=createPosts
/*
$users = QueryBuilder::for(User::class)
    ->allowedFilters([
        AllowedFilter::custom('permission', new FiltersUserPermission()),
    ])
    ->get();
*/
// $users will contain all users that have the `createPosts` permission
