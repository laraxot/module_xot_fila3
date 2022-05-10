<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Xot\Models\Metatag;

class MetatagFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Metatag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'id' => $this->faker->randomNumber,
            'title' => $this->faker->sentence,
            'subtitle' => $this->faker->word,
            'charset' => $this->faker->word,
            'author' => $this->faker->word,
            'meta_description' => $this->faker->text,
            'meta_keywords' => $this->faker->text,
            'logo_src' => $this->faker->word,
            'logo_footer_src' => $this->faker->word,
            'tennant_name' => $this->faker->word,
            'sitename' => $this->faker->word,
            'created_at' => $this->faker->dateTime,
            'created_by' => $this->faker->word,
            'updated_at' => $this->faker->dateTime,
            'updated_by' => $this->faker->word,
        ];
    }
}
