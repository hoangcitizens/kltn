<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Danh mục cho blog
        Category::create([
            'name' => 'Tiệc cưới',
            'slug' => 'tiec-cuoi',
            'description' => 'Các bài viết về tiệc cưới'
        ]);

        // Danh mục cho thiết bị
        Category::create([
            'name' => 'Thiết bị âm thanh',
            'slug' => 'thiet-bi-am-thanh',
            'description' => 'Các thiết bị âm thanh cho sự kiện'
        ]);

        Category::create([
            'name' => 'Thiết bị ánh sáng',
            'slug' => 'thiet-bi-anh-sang',
            'description' => 'Các thiết bị ánh sáng cho sự kiện'
        ]);
    }
} 