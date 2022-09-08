<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use Modules\Xot\Models\Profile;

class ProfileFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
<<<<<<< HEAD
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Modules\Xot\Models\Profile::class;
=======
     * @var string
     */
    protected $model = Profile::class;
>>>>>>> 9472ad4 (first)

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
       

        return [
            'id' => $this->faker->randomNumber,
            'user_id' => $this->faker->integer
        ];
    }
}
