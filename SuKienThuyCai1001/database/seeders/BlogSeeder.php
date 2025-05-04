<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run()
    {
        $category = Category::where('slug', 'tiec-cuoi')->first();

        if (!$category) {
            return;
        }

        $posts = [
            [
                'title' => '10 Xu Hướng Trang Trí Tiệc Cưới Nổi Bật Năm 2024',
                'content' => 'Năm 2024 mang đến nhiều xu hướng trang trí tiệc cưới mới lạ và độc đáo. Từ phong cách tối giản đến những thiết kế cầu kỳ, các cặp đôi có nhiều lựa chọn để tạo nên một đám cưới đáng nhớ.',
                'excerpt' => 'Khám phá những xu hướng trang trí tiệc cưới mới nhất năm 2024, từ phong cách tối giản đến những thiết kế cầu kỳ.',
                'image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'category_id' => $category->id
            ],
            [
                'title' => 'Bí Quyết Lựa Chọn Địa Điểm Tổ Chức Tiệc Cưới Hoàn Hảo',
                'content' => 'Việc lựa chọn địa điểm tổ chức tiệc cưới là một trong những quyết định quan trọng nhất trong quá trình lên kế hoạch đám cưới. Bài viết này sẽ giúp bạn tìm ra địa điểm phù hợp nhất với phong cách và ngân sách của mình.',
                'excerpt' => 'Hướng dẫn chi tiết về cách lựa chọn địa điểm tổ chức tiệc cưới phù hợp với phong cách và ngân sách của bạn.',
                'image' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'category_id' => $category->id
            ],
            [
                'title' => 'Cách Lên Kế Hoạch Tiệc Cưới Trong 6 Tháng',
                'content' => 'Lên kế hoạch cho một đám cưới có thể là một thử thách lớn, đặc biệt khi bạn chỉ có 6 tháng để chuẩn bị. Bài viết này sẽ cung cấp cho bạn một lộ trình chi tiết để tổ chức một đám cưới hoàn hảo trong thời gian ngắn.',
                'excerpt' => 'Lộ trình chi tiết giúp bạn lên kế hoạch và tổ chức một đám cưới hoàn hảo chỉ trong 6 tháng.',
                'image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'category_id' => $category->id
            ]
        ];

        foreach ($posts as $post) {
            $post['slug'] = Str::slug($post['title']);
            Blog::create([
                'title' => $post['title'],
                'content' => $post['content'],
                'excerpt' => $post['excerpt'],
                'slug' => $post['slug'],
                'category_id' => $post['category_id'],
                'image' => $post['image']
            ]);
        }
    }
} 