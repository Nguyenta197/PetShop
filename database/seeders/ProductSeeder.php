<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Tạo bản ghi
        $proSeed = [];
        for ($i = 0; $i < 10; $i++) {
            $proSeed[] = [
                'name' => fake() -> name(),
                'price' => fake() -> randomFloat(0, 10000000, 30000000),
                'quantity' => fake() -> numberBetween(1, 100),
                'image' => fake() -> url(),
                'category_id' => fake() -> randomElement([1, 2, 3, 4, 5]),
                'description' => fake() -> text(),
                'created_at' => now(),
                'updated_at' => now(),
                'status' => fake() -> randomElement([0, 1]),
            ];
        }

        DB::table('products')->insert($proSeed);
    }
}
