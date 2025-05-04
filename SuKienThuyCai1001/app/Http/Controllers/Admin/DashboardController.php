<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Blog;
use App\Models\Category;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $equipmentCount = Equipment::count();
        $blogCount = Blog::count();
        $categoryCount = Category::count();
        
        $latestEquipment = Equipment::with('category')
            ->latest()
            ->take(5)
            ->get();
            
        $latestBlogs = Blog::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'equipmentCount',
            'blogCount',
            'categoryCount',
            'latestEquipment',
            'latestBlogs'
        ));
    }
} 