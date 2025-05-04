<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Category;
use App\Models\EquipmentType;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipment = Equipment::with('category')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.equipment.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $equipmentTypes = EquipmentType::all();
        return view('admin.equipment.create', compact('categories', 'equipmentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:available,rented,maintenance',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'equipment_type_id' => 'required|exists:equipment_types,id'
        ]);

        $data = $request->except('categories');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('equipment', 'public');
            $data['image'] = $path;
    }

        $equipment = Equipment::create($data);
        $equipment->categories()->attach($request->categories);

        return redirect()->route('admin.equipment.index')
            ->with('success', 'Thiết bị đã được thêm thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $equipment = Equipment::with('categories')->findOrFail($id);
        
        // Lấy thiết bị liên quan (cùng danh mục)
        $relatedEquipment = Equipment::whereHas('categories', function($query) use ($equipment) {
            $query->whereIn('categories.id', $equipment->categories->pluck('id'));
        })
        ->where('id', '!=', $equipment->id)
        ->where('status', 'available')
        ->take(4)
        ->get();

        // Lấy bài viết liên quan
        $relatedBlogs = Blog::whereHas('category', function($query) use ($equipment) {
            $query->whereIn('categories.id', $equipment->categories->pluck('id'));
        })
        ->latest()
        ->take(5)
        ->get();

        return view('Sukien.equipment.show', compact('equipment', 'relatedEquipment', 'relatedBlogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment)
    {
        $categories = Category::all();
        $equipmentTypes = EquipmentType::all();
        return view('admin.equipment.edit', compact('equipment', 'categories', 'equipmentTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:available,rented,maintenance',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'equipment_type_id' => 'required|exists:equipment_types,id'
        ]);

        $data = $request->except('categories');

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($equipment->image) {
                Storage::disk('public')->delete($equipment->image);
            }
            $path = $request->file('image')->store('equipment', 'public');
            $data['image'] = $path;
        }

        $equipment->update($data);
        $equipment->categories()->sync($request->categories);

        return redirect()->route('admin.equipment.index')
            ->with('success', 'Thiết bị đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        if ($equipment->image) {
            Storage::disk('public')->delete($equipment->image);
        }
        
        $equipment->delete();

        return redirect()->route('admin.equipment.index')
            ->with('success', 'Thiết bị đã được xóa thành công.');
    }

    public function getByType($type)
    {
        $equipmentTypes = EquipmentType::all();
        $equipmentType = null;

        if($type == 'all'){
            $equipment = Equipment::with(['category', 'equipmentType'])
                ->where('status', 'available')
                ->paginate(8);
        } else {
            $equipmentType = EquipmentType::where('id', $type)->firstOrFail();
            $equipment = Equipment::with(['category', 'equipmentType'])
                ->where('equipment_type_id', $type)
                ->where('status', 'available')
                ->paginate(12);
        }

        return view('Sukien.equipment.index', compact('equipment', 'equipmentTypes', 'equipmentType'));
    }
} 