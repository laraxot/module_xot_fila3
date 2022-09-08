<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
<<<<<<< HEAD
use Illuminate\Support\Str;

use Modules\Xot\Models\Job;

=======
use Modules\Xot\Models\Job;

/**
 * Undocumented class.
 */
>>>>>>> 9472ad4 (first)
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
>>>>>>> 9472ad4 (first)

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
<<<<<<< HEAD
       

=======
>>>>>>> 9472ad4 (first)
        return [
            'id' => $this->faker->randomNumber,
            'queue' => $this->faker->word,
            'payload' => $this->faker->text,
            'attempts' => $this->faker->boolean,
            'reserved_at' => $this->faker->randomNumber,
            'available_at' => $this->faker->randomNumber,
<<<<<<< HEAD
            'created_at' => $this->faker->randomNumber
        ];
    }
}
=======
            'created_at' => $this->faker->randomNumber,
        ];
    }
}
>>>>>>> 9472ad4 (first)
