<?php

namespace Database\Factories;

use App\Models\book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{

    protected $model = book::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->sentence(3),  // Generates random sentence
            'visuals' => $this->faker->word(),        // Generates a random word
            'book_cover' => $this->faker->word(),     // Generates a random word for book cover
            'layout_formating' => $this->faker->numberBetween(10, 20),  // Random number between 10-20
            'genres' => $this->faker->word(),         // Generates a random genre
            'physical_attributes' => 'Hard Books',    // You can keep static values like this
            'interactive_elements' => 'Best Seller',  // Static value
        ];
    }
}
