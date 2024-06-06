<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create();

        // for ($i = 0; $i < 10; $i++) {
        //     Order::create([
        //         'client_id' => $faker->randomNumber(),
        //         'book_id' => $faker->randomNumber(),
        //         'status' => 'waiting',
        //         'takDate' => $faker->dateTimeBetween('-1 month', '+1 month'),
        //         'retDate' => $faker->dateTimeBetween('+1 day', '+1 month')
        //     ]);
        // }
    }
}
