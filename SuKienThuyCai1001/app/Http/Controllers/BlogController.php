<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Staff;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category', 'author')
            ->latest()
            ->paginate(6);
        return view('Sukien.blog.index', compact('blogs'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'required|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->content = $request->content;
        $blog->excerpt = $request->excerpt;
        $blog->category_id = $request->category_id;
        $blog->author_id = auth()->id();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/blogs', $imageName);
            $blog->image = 'blogs/' . $imageName;
        }
        $blog->save();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'required|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->content = $request->content;
        $blog->excerpt = $request->excerpt;
        $blog->category_id = $request->category_id;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($blog->image) {
                Storage::delete('public/' . $blog->image);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/blogs', $imageName);
            $blog->image = 'blogs/' . $imageName;
        }
        $blog->save();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }
    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::delete('public/' . $blog->image);
        }
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $blogs = Blog::where('category_id', $category->id)
            ->with('category', 'author')
            ->latest()
            ->paginate(6);
        return view('blog.category', compact('category', 'blogs'));
    }
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->with('category', 'author')
            ->firstOrFail();

        // Lấy các bài viết liên quan (cùng category) với phân trang
        $relatedBlogs = Blog::where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->with('category', 'author')
            ->latest()
            ->paginate(5);

        // Lấy thiết bị liên quan thông qua bảng trung gian equipment_category
        $relatedEquipment = Equipment::whereHas('categories', function ($query) use ($blog) {
            $query->where('categories.id', $blog->category_id);
        })->where('status', 'available')->paginate(5);
        // Lấy thiết bị cho slider thông qua bảng trung gian equipment_category
        $sliderEquipment = Equipment::whereHas('categories', function ($query) use ($blog) {
            $query->where('categories.id', $blog->category_id);
        })->where('status', 'available')->take(10)->get();
        // Lấy nhân sự cho thuê
        $staffs = Staff::paginate(10);
        return view('blog.show', compact(
            'blog',
            'relatedBlogs',
            'relatedEquipment',
            'sliderEquipment',
            'staffs'
        ));
    }
}