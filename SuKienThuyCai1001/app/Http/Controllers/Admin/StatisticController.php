<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Models\StaffRental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        // Get date range from request or use default (last 30 days)
        $startDate = $request->filled('start_date') 
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->subDays(30)->startOfDay();
            
        $endDate = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfDay();

        // Revenue statistics
        $equipmentBookings = Booking::whereIn('status', ['approved','returned'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
            
        $staffRentals = StaffRental::where('status', 'approved')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $equipmentRevenue = $equipmentBookings->sum('total_price');
        $staffRevenue = $staffRentals->sum('total_price');
        $totalRevenue = $equipmentRevenue + $staffRevenue;

        $equipmentCount = $equipmentBookings->count();
        $staffCount = $staffRentals->count();

        // Blog statistics
        $totalBlogs = Blog::count();
        $recentBlogs = Blog::whereBetween('created_at', [$startDate, $endDate])->count();

        // Equipment statistics
        $totalEquipment = Equipment::count();
        $availableEquipment = Equipment::where('quantity', '>', 0)->count();
        $categories = Category::withCount('equipment')->get();

        // Equipment by type statistics
        $equipmentTypes = EquipmentType::all();
        $equipmentByType = [];
        foreach ($equipmentTypes as $type) {
            $count = Equipment::where('equipment_type_id', $type->id)->count();
            $available = Equipment::where('equipment_type_id', $type->id)
                ->where('quantity', '>', 0)
                ->count();
            $equipmentByType[] = [
                'equipment_type_name' => $type->equipment_type_name,
                'count' => $count,
                'available' => $available
            ];
        }

        // Staff rental statistics
        $totalStaffRentals = StaffRental::count();
        $pendingStaffRentals = StaffRental::where('status', 'pending')->count();
        $approvedStaffRentals = StaffRental::where('status', 'approved')->count();
        $rejectedStaffRentals = StaffRental::where('status', 'rejected')->count();
        $completedStaffRentals = StaffRental::where('status', 'completed')->count();

        return view('admin.statistics.index', compact(
            'startDate',
            'endDate',
            'totalRevenue',
            'equipmentRevenue',
            'staffRevenue',
            'equipmentCount',
            'staffCount',
            'totalBlogs',
            'recentBlogs',
            'totalEquipment',
            'availableEquipment',
            'categories',
            'equipmentByType',
            'totalStaffRentals',
            'pendingStaffRentals',
            'approvedStaffRentals',
            'rejectedStaffRentals',
            'completedStaffRentals'
        ));
    }
}