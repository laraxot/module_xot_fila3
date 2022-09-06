<?php

declare(strict_types=1);

namespace Modules\Xot\DTOs;

use Illuminate\Support\Arr;
use Spatie\LaravelData\Data;

/**
 * Undocumented class.
 */
class FieldFilterDTO extends Data {
    public string $param_name;
    public string $field_name;
    public ?string $where_method = null;
    /**
     * Undocumented variable.
     *
     * @var string|array|null
     */
    public $rules;

    /**
     * Undocumented function.
     */
    public function __construct(
        string $param_name,
        string $field_name,
        string $where_method = null,
        $rules,
     ) {
        $this->param_name = $param_name;
        $this->field_name = $field_name;
        $this->where_method = $where_method;
        $rules = Arr::wrap($rules);

        $this->rules = $rules;
    }
}
