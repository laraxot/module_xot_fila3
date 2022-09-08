<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
<<<<<<< HEAD
use Illuminate\Support\Str;

use Modules\Xot\Models\JobBatch;

=======
use Modules\Xot\Models\JobBatch;

/**
 * Undocumented class.
 */
>>>>>>> 9472ad4 (first)
class JobBatchFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
<<<<<<< HEAD
     * @var class-string<\Illuminate\Database\Eloquent\Model>
=======
     * @var string
>>>>>>> 9472ad4 (first)
     */
    protected $model = JobBatch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
<<<<<<< HEAD
       

        return [
            'id' => $this->faker->word
        ];
    }
}
=======
        return [
            'id' => $this->faker->word,
            'name' => $this->faker->name,
            'total_jobs' => $this->faker->randomNumber,
            'pending_jobs' => $this->faker->randomNumber,
            'failed_jobs' => $this->faker->randomNumber,
            'failed_job_ids' => $this->faker->text,
            'options' => $this->faker->text,
            'cancelled_at' => $this->faker->randomNumber,
            'created_at' => $this->faker->randomNumber,
            'finished_at' => $this->faker->randomNumber,
        ];
    }
}
>>>>>>> 9472ad4 (first)
