<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->truncate(); // reset ID auto increment và dữ liệu cũ

        $cateSeed = [];
        for ($i = 0; $i < 10; $i++) {
            $cateSeed[] = [
                'name' => fake()->name(),
                'status' => fake()->numberBetween(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('categories')->insert($cateSeed);
    }

}
