<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
<<<<<<< HEAD
use Modules\Xot\Models\Feed;

/**
 * Undocumented class.
 */
=======
use Illuminate\Support\Str;

use Modules\Xot\Models\Feed;

>>>>>>> 05f4961 (.)
class FeedFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feed::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
<<<<<<< HEAD
        return [
            'id' => $this->faker->randomNumber,
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
=======
       

        return [
            'id' => $this->faker->randomNumber
        ];
    }
}
>>>>>>> 05f4961 (.)
