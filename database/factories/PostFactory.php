<?php

namespace Database\Factories;

use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $numTitleWords = rand(1, 6);
        
        $imageFolder = 'storage/app/public';
        $fullImagePath = $this->faker->optional()->image($imageFolder . '/post-images');
        $imagePath = substr($fullImagePath, strlen($imageFolder) + 1);

        return [
            "title" => $this->faker->words($numTitleWords, true),
            "content" => $this->faker->paragraph(5),
            "date_time_posted" => $this->faker->dateTimeThisYear->format("Y-m-d H:i:s"),
            "project_link" => $this->faker->optional()->url,
            "image_path" => $imagePath,
        ];
    }
}
