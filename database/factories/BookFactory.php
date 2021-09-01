<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $pages = config('seeders.books.number_of_pages', [50, 1500]);
        $quantity = config('seeders.books.quantity', [1, 10]);

        return [
            // @ts-ignore
            'title' => ucwords($this->faker->words(3, true)),
            'number_of_pages' => rand($pages[0], $pages[1]),
            'publisher_id' => Publisher::all()->map(function ($publisher) {
                return $publisher->id;
            })->shuffle()->first(),
            'quantity' => rand($quantity[0], $quantity[1]),
        ];
    }
}
