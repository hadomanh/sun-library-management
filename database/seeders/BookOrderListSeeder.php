<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{BookOrder, Book};

class BookOrderListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [];
        for ($i=0; $i < rand(1, 20); $i++) {
            do {
                $book = Book::withCount('orders')->get()->shuffle()->first();
            } while (in_array($book->id, $books));
            array_push($books, $book->id);
            $orders = [];
            for ($j = 0; $j < rand(1, $book->quantity - $book->order_count); $j++) {
                do {
                    $order = BookOrder::all()->shuffle()->first();
                } while(in_array($order->id, $orders) || $book->orders->contains($order->id));
                array_push($orders, $order->id);
            }
            $book->orders()->attach($orders);
        };
    }
}
