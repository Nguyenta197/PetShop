<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ và reset auto increment nếu cần
        DB::table('products')->truncate();

        // Lấy danh sách ID thực tế từ bảng categories
        $categoryIds = Category::pluck('id')->toArray();

        // Nếu chưa có category nào, dừng seed
        if (empty($categoryIds)) {
            $this->command->warn('⚠️ Chưa có dữ liệu category. Vui lòng seed categories trước.');
            return;
        }

        // Tạo dữ liệu seed cho products
        $proSeed = [];
        for ($i = 0; $i < 10; $i++) {
            $proSeed[] = [
                'name' => fake()->name(),
                'price' => fake()->randomFloat(0, 10000000, 30000000),
                'quantity' => fake()->numberBetween(1, 100),
                'image' => fake()->imageUrl(),
                'category_id' => fake()->randomElement($categoryIds),
                'description' => fake()->text(),
                'status' => fake()->randomElement([0, 1]),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('products')->insert($proSeed);

        $this->command->info('✅ Đã seed bảng sản phẩm (products) thành công!');
    }
}
