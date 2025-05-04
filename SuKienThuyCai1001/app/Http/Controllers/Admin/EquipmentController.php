<?php

namespace App\Http\Controllers\Admin;

use App\Models\Equipment;
use App\Models\Category;
use App\Models\EquipmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\BookingRequest;
use App\Models\Booking;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::with('category')->latest()->paginate(10);
        return view('admin.equipment.index', compact('equipment'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.equipment.create', compact('categories'));
    }

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

    public function edit(Equipment $equipment)
    {
        $categories = Category::all();
        $equipmentTypes = EquipmentType::all();
        return view('admin.equipment.edit', compact('equipment', 'categories', 'equipmentTypes'));
    }

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

    public function destroy(Equipment $equipment)
    {
        if ($equipment->image) {
            Storage::delete('public/' . $equipment->image);
        }
        
        $equipment->delete();
        return redirect()->route('admin.equipment.index')->with('success', 'Equipment deleted successfully.');
    }

    public function rentalRequests()
    {
        $rentals = BookingRequest::with(['user', 'equipment'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.equipment.rentals', compact('rentals'));
    }

    public function rentalRequestDetail($id)
    {
        $rental = BookingRequest::with(['user', 'equipment'])
            ->findOrFail($id);
            
        return view('admin.equipment.rental-detail', compact('rental'));
    }

    public function approveRental(Request $request, $id)
    {
        $rental = BookingRequest::findOrFail($id);
        
        // Kiểm tra xem thiết bị có đủ số lượng không
        $equipment = $rental->equipment;
        if ($equipment->quantity < $rental->quantity) {
            return redirect()->back()
                ->with('error', 'Số lượng thiết bị không đủ để cho thuê.');
        }
        
        // Cập nhật trạng thái yêu cầu
        $rental->status = 'approved';
        $rental->save();
        
        // Cập nhật số lượng thiết bị còn lại
        $equipment->quantity -= $rental->quantity;
        $equipment->save();
        
        return redirect()->route('admin.equipment.rentals')
            ->with('success', 'Đã duyệt yêu cầu thuê thiết bị.');
    }

    public function rejectRental(Request $request, $id)
    {
        $rental = BookingRequest::findOrFail($id);
        $rental->status = 'rejected';
        $rental->save();
        
        return redirect()->route('admin.equipment.rentals')
            ->with('success', 'Đã từ chối yêu cầu thuê thiết bị.');
    }

    public function markAsReturned($booking_id)
    {
        $booking = BookingRequest::findOrFail($booking_id);
        
        if ($booking->status !== 'approved') {
            return back()->with('error', 'Không thể đánh dấu đã trả với trạng thái hiện tại.');
        }

        $booking->status = 'returned';
        $booking->save();

        // Cập nhật số lượng thiết bị có sẵn
        $equipment = $booking->equipment;
        $equipment->update([
            'quantity' => $equipment->quantity + $booking->quantity
        ]);

        return back()->with('success', 'Thiết bị đã được đánh dấu là đã trả.');
    }
} 