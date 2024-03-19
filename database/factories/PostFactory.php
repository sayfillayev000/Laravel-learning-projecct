<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    public function definition()
    {
        return [
            'user_id' => 1, //User::factory(),
            'category_id' => rand(1,5), //User::factory(),
            'title' => $this->faker->title(),
            'phone_number' => $this->faker->phoneNumber(),
            'short_content' => $this->faker->sentence(15),
            'content' => $this->faker->paragraph(15),
        ];
    }
}
