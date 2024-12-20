<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model\Update;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\App;
use Modules\Xot\Datas\RelationData as RelationDTO;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

/**
 * Class MorphOneAction.
 *
 * @description Handles morphOne relationship updates and creation with strict typing
 */
final class MorphOneAction
{
    use QueueableAction;

    /**
     * Execute the morphOne relationship action.
     *
     * @param Model       $model       The model instance
     * @param RelationDTO $relationDTO The relation data transfer object
     *
     * @throws \InvalidArgumentException When relation is not MorphOne
     * @throws \RuntimeException         When data array is invalid
     */
    public function execute(Model $model, RelationDTO $relationDTO): void
    {
        Assert::isInstanceOf($relation = $relationDTO->rows, MorphOne::class);

        $data = $this->validateAndPrepareData($relationDTO->data);

        if ($relation->exists()) {
            $relation->update($data);

            return;
        }

        $relation->create($data);
    }

    /**
     * Validate and prepare the data array.
     *
     * @param array<string, mixed> $data The input data array
     *
     * @return array<string, mixed>
     */
    private function validateAndPrepareData(array $data): array
    {
        if (! isset($data['lang'])) {
            $data['lang'] = App::getLocale();
        }

        return array_filter($data, static function ($value): bool {
            return null !== $value;
        });
    }
}
