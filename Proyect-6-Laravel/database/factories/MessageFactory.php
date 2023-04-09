<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'comments' => fake()->comments(),
            'user_id' => fake()->rand(1,13) ->unique(),
            'party_id' => fake()->rand(1,4) ->party_id(),
        ];
    }
}
