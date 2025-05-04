<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffRental;
use Illuminate\Http\Request;

class StaffRentalController extends Controller
{
    public function index()
    {
        $rentals = StaffRental::with(['staff', 'user'])
            ->latest()
            ->paginate(10);
        
        return view('admin.staff-rentals.index', compact('rentals'));
    }

    public function show(StaffRental $rental)
    {
        $rental->load(['staff', 'user']);
        return view('admin.staff-rentals.show', compact('rental'));
    }

    public function approve(StaffRental $rental)
    {
        if ($rental->status !== 'pending') {
            return back()->with('error', 'Không thể duyệt yêu cầu thuê này.');
        }

        $rental->update(['status' => 'approved']);

        return back()->with('success', 'Yêu cầu thuê đã được duyệt thành công.');
    }

    public function reject(StaffRental $rental)
    {
        if ($rental->status !== 'pending') {
            return back()->with('error', 'Không thể từ chối yêu cầu thuê này.');
        }

        $rental->update(['status' => 'rejected']);

        return back()->with('success', 'Yêu cầu thuê đã bị từ chối.');
    }

    public function destroy(StaffRental $rental)
    {
        $rental->delete();

        return redirect()->route('admin.staff-rentals.index')
            ->with('success', 'Yêu cầu thuê đã được xóa thành công.');
    }
} 