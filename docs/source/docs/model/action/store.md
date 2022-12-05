---
title: Store Action
description: Store Model with Queuable Action
extends: _layouts.documentation
section: content
---
# Store Action {#store-action}

This is Store quauable action

Action File Path:

```php
laravel/Modules/Xot/Actions/Model/StoreAction.php
```

## What it does:

It takes three params:

* the **model** calling the store action
* the **data** array to store
*  the **rules** needed to validate data

```php
public function execute(Model $row, array $data, array $rules): Model {
```

* If there is a fillable field named *lang*;
* If *lang* is not set in data;
* Then data get *lang* from the website Locale configuration.

```php
if (! isset($data['lang']) && \in_array('lang', $row->getFillable(), true)) {
    $data['lang'] = app()->getLocale();
}
```

