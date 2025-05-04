<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Equipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!Session::has('user_id') || Session::get('user_role') !== 'admin') {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập trang này');
        }

        $totalUsers = User::count();
        $totalBookings = Booking::count();
        $totalEquipment = Equipment::count();
        
        $recentBookings = Booking::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('Sukien.admin.dashboard', compact(
            'totalUsers',
            'totalBookings',
            'totalEquipment',
            'recentBookings'
        ));
    }
} 