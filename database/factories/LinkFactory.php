<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Link>
 */
class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => $this->faker->sentence(3),
            "description" => $this->faker->text(200),
            "logo" => $this->faker->imageUrl(),
            "link_name" => $this->faker->userName(),
            "user_id" => User::factory()->create(),
            "color" => $this->faker->hexColor(),
            "text_color" => $this->faker->hexColor()
        ];
    }
}
