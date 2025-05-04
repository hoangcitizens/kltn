<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Equipment;

class ServiceController extends Controller
{
    public function wedding()
    {
        // Lấy danh mục tiệc cưới
        $category = Category::where('slug', 'tiec-cuoi')->first();
        
        if (!$category) {
            abort(404);
        }

        // Lấy các bài viết thuộc danh mục tiệc cưới
        $posts = Blog::where('category_id', $category->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(6);

        return view('services.wedding', compact('posts', 'category'));
    }

    public function showWeddingPost($slug)
    {
        // Lấy bài viết theo slug
        $post = Blog::where('slug', $slug)->firstOrFail();
        
        // Lấy danh mục tiệc cưới
        $category = Category::where('slug', 'tiec-cuoi')->first();
        
        // Lấy ngẫu nhiên 4 thiết bị liên quan
        $relatedEquipments = Equipment::inRandomOrder()
                                    ->limit(4)
                                    ->get();

        return view('services.wedding-post', compact('post', 'category', 'relatedEquipments'));
    }
} 