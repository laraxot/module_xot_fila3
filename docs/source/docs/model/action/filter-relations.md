---
title: Filter Relations Action
description: Filter Relations Model with Queuable Action
extends: _layouts.documentation
section: content
---

# Filter Relations Action {#filter-relations}

This is Filter Relations quauable action

Action File Path:

```php
laravel/Modules/Xot/Actions/Model/FilterRelationsAction.php
```

## What it does:

It takes three params:

* the **model** calling the store action
* the **data** array to store

```php
public function execute(Model $model, array $data): Collection {
```

Get the methods of the model to store

```php
$methods = get_class_methods($model);
```

### How the filter works

Transforms the array of data to save to a *Collection* (Illuminate\Support\Collection)

```php
$res = collect($data)
```

* Checks if $item exists in $methods
* While the third parameter (strict) is true, then it check the type of found value in array too
* *Then only if the attribute is a method instead of a simple property then is returned by filter*

```php
->filter(
    function ($item) use ($methods) {
        return \in_array($item, $methods, true);
    })
```

If the previously filtered model method is a relation instance then it is returned by this filter

```php
->filter(
    function ($item) use ($model) {
        $rows = $model->$item();
        return $rows instanceof \Illuminate\Database\Eloquent\Relations\Relation;
    })
```

The returned relations 

```php
->map(function ($item) use ($model) {
            $rows = $model->$item();
            $related = null;
            if (method_exists($rows, 'getRelated')) {
                $related = $rows->getRelated();
            }

            return (object) [
                'relationship_type' => class_basename($rows),
                'related' => $related,
                'name' => $item,
                'rows' => $rows,
            ];
        });
        ```

```php
return $res;
```


