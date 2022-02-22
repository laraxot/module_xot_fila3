<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use Modules\Xot\Models\Widget;

class WidgetFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Widget::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
       

        return [
            'id' => $this->faker->randomNumber,
            'post_type' => $this->faker->word,
            'post_id' => $this->faker->integer,
            'title' => $this->faker->sentence,
            'blade' => $this->faker->word,
            'pos' => $this->faker->randomNumber,
            'model' => $this->faker->word,
            'limit' => $this->faker->randomNumber,
            'order_by' => $this->faker->word,
            'image_src' => $this->faker->word,
            'layout_position' => $this->faker->word
        ];
    }
}
