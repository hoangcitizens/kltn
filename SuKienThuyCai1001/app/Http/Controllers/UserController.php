<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để truy cập trang này');
        }

        $user = User::find(Session::get('user_id'));
        return view('Sukien.user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thực hiện thao tác này');
        }

        $request->validate([
            'phone' => 'nullable|string|max:15',
        ]);

        $user = User::find(Session::get('user_id'));
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Cập nhật thông tin thành công');
    }

    public function bookings()
    {
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để truy cập trang này');
        }

        $bookings = Booking::where('user_id', Session::get('user_id'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('Sukien.user.bookings', compact('bookings'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = \App\Models\User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        $user = \App\Models\User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role ?? 'customer',
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Người dùng đã được tạo thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = \App\Models\User::where('user_id', $id)->firstOrFail();
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);

        $rules = [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'role' => 'required|string|in:customer,admin',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8|confirmed';
        }
        
        $request->validate($rules);

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role ?? $user->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Người dùng đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = \App\Models\User::where('user_id', $id)->firstOrFail();
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Người dùng đã được xóa thành công.');
    }
} 