<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Publisher::factory(3)->create();
    }
}
