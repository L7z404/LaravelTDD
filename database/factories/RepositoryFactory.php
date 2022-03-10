<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Repository;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepositoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'url' => $this->faker->url,
            'descripcion' => $this->faker->text,
        ];
    }
}
