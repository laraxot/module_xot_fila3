<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Xot\Models\Home;

/**
 * Undocumented class.
 */
class HomeFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
<<<<<<< HEAD
     * @var class-string<\Illuminate\Database\Eloquent\Model>
=======
     * @var string
>>>>>>> 9472ad4 (first)
     */
    protected $model = Home::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'id' => $this->faker->word,
            'icon_src' => $this->faker->word,
        ];
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9472ad4 (first)
