<?php

namespace Database\Factories;

use App\Models\{Book, Publisher, User, Author, Category};
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
            'publisher_id' => Publisher::all()->shuffle()->first()->id,
            'quantity' => rand($quantity[0], $quantity[1]),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Book $book) {
            $rating = config('seeders.books.rating', [1, 5]);
            $userIds = [];
            $authorIds = [];
            $categoryIds = [];
            for ($i=0; $i < rand(1, 5); $i++) {
                do {
                    $userId = User::all()->shuffle()->first()->id;
                } while (in_array($userId, $userIds) || $book->ratingsAndComments->contains($userId));
                array_push($userIds, $userId);
                $book->ratingsAndComments()->attach(
                    $userId,
                    ['rating' => rand($rating[0], $rating[1]), 'comment' => $this->faker->paragraph()]
                );
            };
            for ($i=0; $i < rand(1, 3); $i++) {
                do {
                    $authorId = Author::all()->shuffle()->first()->id;
                } while (in_array($authorId, $authorIds) || $book->authors->contains($authorId));
                array_push($authorIds, $authorId);
                $book->authors()->attach($authorId);
            };
            for ($i=0; $i < rand(1, 3); $i++) {
                do {
                    $categoryId = Category::all()->shuffle()->first()->id;
                } while (in_array($categoryId, $categoryIds) || $book->categories->contains($categoryId));
                array_push($categoryIds, $categoryId);
                $book->categories()->attach($categoryId);
            };
        });
    }
}
