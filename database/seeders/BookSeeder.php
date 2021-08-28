<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Book::factory(10)
            ->hasAuthors(rand(1, 3))
            ->hasCategories(rand(1, 3))
            ->create();
    }
}
