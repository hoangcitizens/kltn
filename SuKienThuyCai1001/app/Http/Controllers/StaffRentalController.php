<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\StaffRental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StaffRentalController extends Controller
{
    public function index()
    {
        $rentals = StaffRental::where('user_id', session('user_id'))
            ->with('staff')
            ->latest()
            ->paginate(10);
            
        return view('staff-rentals.index', compact('rentals'));
    }

    public function create(Staff $staff)
    {
        return view('staff-rentals.create', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'rental_date' => 'required|date|after_or_equal:today',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        $staff = Staff::findOrFail($request->staff_id);
        $totalPrice = $staff->price * $request->quantity;

        $rental = StaffRental::create([
            'staff_id' => $request->staff_id,
            'user_id' => session('user_id'),
            'rental_date' => $request->rental_date,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        return redirect()->route('staff.rentals.show', $rental->id)
            ->with('success', 'Yêu cầu thuê nhân sự đã được gửi thành công!');
    }

    public function show(StaffRental $rental)
    {
        return view('staff-rentals.show', compact('rental'));
    }

    public function cancel(StaffRental $rental)
    {
        if ($rental->status !== 'pending') {
            return back()->with('error', 'Không thể hủy yêu cầu thuê này.');
        }

        $rental->update(['status' => 'rejected']);

        return back()->with('success', 'Yêu cầu thuê đã được hủy thành công.');
    }

    public function destroy(StaffRental $rental)
    {
        if ($rental->status !== 'pending') {
            return back()->with('error', 'Không thể xóa yêu cầu thuê này.');
        }

        $rental->delete();

        return redirect()->route('staff.rentals.index')
            ->with('success', 'Yêu cầu thuê đã được xóa thành công.');
    }
} 