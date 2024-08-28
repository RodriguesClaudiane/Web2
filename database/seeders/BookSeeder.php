<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'author_id' => Author::factory(), // Relaciona com um autor fake
            'category_id' => Category::inRandomOrder()->first()->id, // Relaciona com uma categoria existente
            'published_year' => $this->faker->year()
        ];
    }
}
