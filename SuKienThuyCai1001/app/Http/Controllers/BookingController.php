<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingRequest;
use App\Models\Service;
use App\Models\Equipment;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = BookingRequest::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('bookings.index', compact('bookings'));
    }

    public function create(Request $request,$id)
    {
        $equipment = Equipment::findOrFail($id);
        return view('Sukien.bookings.create', compact('equipment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'quantity' => 'required|integer|min:1',
        ]);

        $equipment = Equipment::findOrFail($request->equipment_id);

        // Kiểm tra số lượng thiết bị còn lại
        if ($equipment->quantity < $request->quantity) {
            return back()->with('error', 'Số lượng thiết bị không đủ.');
        }

        // Tạo booking
        $booking = BookingRequest::create([
            'user_id' => session('user_id'),
            'equipment_id' => $request->equipment_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'quantity' => $request->quantity,
            'total_price' => $equipment->price * $request->quantity * 
                           (strtotime($request->end_date) - strtotime($request->start_date)) / (60 * 60 * 24),
            'status' => 'pending',
        ]);

        return redirect()->route('bookings.show', $booking->booking_id)
                        ->with('success', 'Đặt thuê thành công!');
    }

    public function show($id)
    {
        $booking = BookingRequest::with('user')->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = BookingRequest::findOrFail($id);

        // Chỉ cho phép chỉnh sửa khi đơn đặt thuê đang ở trạng thái pending
        if ($booking->status != 'pending') {
            return back()->with('error', 'Không thể chỉnh sửa đơn đặt thuê đã được xử lý.');
        }

        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'quantity' => 'required|integer|min:1',
        ]);

        // Kiểm tra số lượng thiết bị còn lại
        if ($booking->equipment->quantity < $request->quantity) {
            return back()->with('error', 'Số lượng thiết bị không đủ.');
        }

        // Cập nhật booking
        $booking->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'quantity' => $request->quantity,
            'total_price' => $booking->equipment->price * $request->quantity * 
                           (strtotime($request->end_date) - strtotime($request->start_date)) / (60 * 60 * 24),
        ]);

        return redirect()->route('bookings.show', $booking->booking_id)
                        ->with('success', 'Cập nhật đơn đặt thuê thành công!');
    }

    public function userBookings()
    {
        $bookings = BookingRequest::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('bookings.user', compact('bookings'));
    }

    public function edit($id)
    {
        $booking = BookingRequest::findOrFail($id);
        return view('bookings.edit', compact('booking'));
    }

    public function cancel($id)
    {
        $booking = BookingRequest::findOrFail($id);

        // Chỉ cho phép hủy khi đơn đặt thuê đang ở trạng thái pending
        if ($booking->status != 'pending') {
            return back()->with('error', 'Không thể hủy đơn đặt thuê đã được xử lý.');
        }

        // Cập nhật trạng thái thành rejected
        $booking->update(['status' => 'rejected']);

        return redirect()->route('bookings.show', $booking->booking_id)
                        ->with('success', 'Đơn đặt thuê đã được hủy thành công!');
    }

    public function destroy($id)
    {
        $booking = BookingRequest::findOrFail($id);

        // Chỉ cho phép xóa khi đơn đặt thuê đang ở trạng thái pending
        if ($booking->status == 'approved') {
            return back()->with('error', 'Không thể xóa đơn đặt thuê đã được xử lý.');
        }

        $booking->delete();

        return redirect()->route('user.bookings')
                        ->with('success', 'Đơn đặt thuê đã được xóa thành công!');
    }

    public function returnEquipment($id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->status !== Booking::STATUS_APPROVED) {
            return back()->with('error', 'Không thể trả thiết bị với trạng thái hiện tại.');
        }

        $booking->update(['status' => Booking::STATUS_RETURNED]);

        // Cập nhật số lượng thiết bị có sẵn
        $equipment = $booking->equipment;
        $equipment->update([
            'quantity' => $equipment->quantity + $booking->quantity
        ]);

        return back()->with('success', 'Thiết bị đã được trả thành công.');
    }
} 