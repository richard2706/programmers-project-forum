<?php

namespace Database\Factories;

use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "username" => $this->faker->unique()->userName(),
            "user_type" => $this->faker->randomElement(["admin", "standard"]),
            "registration_date" => $this->faker->dateTimeThisYear->format("Y-m-d"),
            "birthday" => $this->faker->optional()->date(),
            "description" => $this->faker->optional()->sentence(),
        ];
    }
}
