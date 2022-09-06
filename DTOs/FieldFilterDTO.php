<?php

declare(strict_types=1);

namespace Modules\Xot\DTOs;

use Spatie\LaravelData\Data;

/**
 * Undocumented class.
 */
class FieldFilterDTO extends Data {
    // *
    public string $param_name;
    public string $field_name;
    public ?string $where_method = null;
    public string $rules;
    // */
    /*
     * Undocumented function.

    public function __construct(
         string $param_name,
         string $field_name,
         ?string $where_method = null,
         string $rules,
     ) {
    }
    */
}