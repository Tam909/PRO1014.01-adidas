<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'id_categories' => 1,
                'name' => 'Giày Adidas UltraBoost',
                'price' => 2500000,
                'img' => 'ultraboost.jpg',
                'description' => 'Giày chạy bộ cao cấp UltraBoost thoải mái và bền.',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_categories' => 1,
                'name' => 'Giày Adidas Stan Smith',
                'price' => 1900000,
                'img' => 'stansmith.jpg',
                'description' => 'Giày thời trang cổ điển Stan Smith.',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_categories' => 2,
                'name' => 'Áo thun Adidas thể thao',
                'price' => 450000,
                'img' => 'aothun.jpg',
                'description' => 'Áo thun thể thao co giãn, thấm hút mồ hôi tốt.',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_categories' => 2,
                'name' => 'Quần thể thao Adidas',
                'price' => 600000,
                'img' => 'quanthe.jpg',
                'description' => 'Quần thể thao Adidas nhẹ và thoải mái.',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_categories' => 1,
                'name' => 'Giày Adidas NMD R1',
                'price' => 2700000,
                'img' => 'nmdr1.jpg',
                'description' => 'Thiết kế hiện đại, đế Boost êm ái.',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
