<?php

declare(strict_types=1);

namespace Modules\Xot\DTOs;

use Spatie\LaravelData\Data;

/**
 * Undocumented class.
 */
class FieldFilterDTO extends Data {
    public string $param_name;
    public string $field_name;
    public string $where_method;
    public array $rules;
    /*
     * Undocumented function.
     */
    // public function __construct(
    //    public string $title,
    //    public string $content,
    // ) {
    // }
}