<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2,4)),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(mt_rand(2, 3)),
            'body' => collect($this->faker->paragraphs(mt_rand(5,10)))
                        ->map(fn($paragraf) => "<p>$paragraf</p>")
                        ->implode(''),
            'user_id' =>  mt_rand(1,4),
            'category_id' => mt_rand(1,4)
        ];
    }
}
