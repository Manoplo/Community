<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommunityLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::all()->random()->id,
            'channel_id' => 1,
            'title' => $this->faker->sentence,
            'link' => $this->faker->url,
            'approved' => 0
        ];
    }
}
