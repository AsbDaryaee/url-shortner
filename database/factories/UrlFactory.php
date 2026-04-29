<?php

namespace Database\Factories;

use App\Models\url;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<url>
 */
class UrlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('-1 day', 'now');

        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(32),
            'uuid' => Str::random(7),
            'url' => $this->faker->url(),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
