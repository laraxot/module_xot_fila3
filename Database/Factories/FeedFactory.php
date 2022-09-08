<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Xot\Models\Feed;

/**
 * Undocumented class.
 */
class FeedFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
<<<<<<< HEAD
     * @var class-string<\Illuminate\Database\Eloquent\Model>
=======
     * @var string
>>>>>>> 9472ad4 (first)
     */
    protected $model = Feed::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
<<<<<<< HEAD
            'id' => $this->faker->randomNumber(5, false),
=======
            'id' => $this->faker->randomNumber,
>>>>>>> 9472ad4 (first)
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
