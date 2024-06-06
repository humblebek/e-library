<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Book::create([
                'name' => $faker->sentence,
                'author' => $faker->name,
                'publishDate' => $faker->date,
                'numPage' => $faker->numberBetween(100, 500),
                'numCopy' => $faker->numberBetween(1, 1000),
                'comment' => $faker->text,
                'image' => $faker->imageUrl(),
                'book_type_id' => $faker->numberBetween(1, 3) // Assuming you have 3 categories
            ]);
        }
    }
}
