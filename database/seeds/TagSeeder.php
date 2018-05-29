<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        \App\Tag::truncate();

        foreach(range(1, 10) as $i) {
            \App\Tag::create([
                'name' => ucfirst($faker->words(rand(1,2), true))
            ]);
        }
    }
}
