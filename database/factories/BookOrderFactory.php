<?php

namespace Database\Factories;

use App\Models\BookOrder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $time = config('seeders.book_orders.time', [3, 14]);

        return [
            'user_id' => User::all()->shuffle()->first()->id,
            'from' => now(),
            'to' => now()->addDays(rand($time[0], $time[1])),
            'status' => config('seeders.book_orders.status', 0),
        ];
    }
}
