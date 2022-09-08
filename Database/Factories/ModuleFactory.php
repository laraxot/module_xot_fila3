<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
<<<<<<< HEAD
=======
use Illuminate\Support\Str;

>>>>>>> 9472ad4 (first)
use Modules\Xot\Models\Module;

class ModuleFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
<<<<<<< HEAD
     * @var class-string<\Illuminate\Database\Eloquent\Model>
=======
     * @var string
>>>>>>> 9472ad4 (first)
     */
    protected $model = Module::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
<<<<<<< HEAD
        return [
            'id' => $this->faker->randomNumber(5, false),
            'name' => $this->faker->name,
=======
       

        return [
            'id' => $this->faker->randomNumber,
            'name' => $this->faker->name
>>>>>>> 9472ad4 (first)
        ];
    }
}
