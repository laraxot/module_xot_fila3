<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
<<<<<<< HEAD

=======
use Modules\Xot\Models\Job;

/**
 * Undocumented class.
 */
>>>>>>> ae3a261 (up)
class JobFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
<<<<<<< HEAD
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Modules\Xot\Models\Job::class;
=======
     * @var string
     */
    protected $model = Job::class;
>>>>>>> ae3a261 (up)

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'id' => $this->faker->randomNumber,
            'queue' => $this->faker->word,
            'payload' => $this->faker->text,
            'attempts' => $this->faker->boolean,
            'reserved_at' => $this->faker->randomNumber,
            'available_at' => $this->faker->randomNumber,
            'created_at' => $this->faker->randomNumber,
        ];
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> ae3a261 (up)
