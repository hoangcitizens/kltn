<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\StaffRental;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::all();
        return view('admin.staff.index', compact('staff'));
    }
    public function indexUser()
    {
        $staffs = Staff::paginate(10);
        return view('Sukien.staff.index', compact('staffs'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/staff', $imageName);
            $data['image'] = 'staff/' . $imageName;
        }

        Staff::create($data);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Nhân sự đã được thêm thành công.');
    }

    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($staff->image) {
                Storage::delete('public/' . $staff->image);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/staff', $imageName);
            $data['image'] = 'staff/' . $imageName;
        }

        $staff->update($data);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Nhân sự đã được cập nhật thành công.');
    }

    public function destroy(Staff $staff)
    {
        if ($staff->image) {
            Storage::delete('public/' . $staff->image);
        }
        $staff->delete();

        return redirect()->route('admin.staff.index')
            ->with('success', 'Nhân sự đã được xóa thành công.');
    }

    public function rentalRequests()
    {
        $rentals = StaffRental::with(['staff', 'user'])
            ->latest()
            ->paginate(10);

        return view('admin.staff.rentals', compact('rentals'));
    }

    public function rentalRequestDetail($id)
    {
        $rental = StaffRental::with(['staff', 'user'])->findOrFail($id);
        return view('admin.staff.rental-detail', compact('rental'));
    }

    public function approveRental(Request $request, $id)
    {
        $rental = StaffRental::findOrFail($id);
        
        if ($rental->status !== 'pending') {
            return back()->with('error', 'Không thể duyệt yêu cầu thuê này.');
        }

        $rental->update(['status' => 'approved']);

        return back()->with('success', 'Yêu cầu thuê đã được duyệt thành công.');
    }

    public function rejectRental(Request $request, $id)
    {
        $rental = StaffRental::findOrFail($id);
        
        if ($rental->status !== 'pending') {
            return back()->with('error', 'Không thể từ chối yêu cầu thuê này.');
        }

        $rental->update(['status' => 'rejected']);

        return back()->with('success', 'Yêu cầu thuê đã bị từ chối.');
    }
} 