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
            'comments' => $this->fake()->sentence(),
            'user_id' => $this->rand(1,3) ->unique(),
            'party_id' => $this->rand(1,4) ->party_id(),
        ];
    }
}
