<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Lưu URL hiện tại vào session trước khi chuyển đến trang đăng nhập
        Session::put('previous_url', url()->previous());
        return view('Sukien.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Lưu thông tin người dùng vào session
            Session::put('user_id', $user->user_id);
            Session::put('user_name', $user->username);
            Session::put('user_role', $user->role);
            
            // Lấy URL trước đó từ session hoặc mặc định là trang chủ
            $previousUrl = Session::get('previous_url', '/');
            Session::forget('previous_url'); // Xóa URL trước đó sau khi sử dụng
            
            return redirect($previousUrl)->with('success', 'Đăng nhập thành công');
        }

        return back()->with('error', 'Email hoặc mật khẩu không đúng');
    }

    public function showRegisterForm()
    {
        return view('Sukien.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer'
        ]);

        Session::put('user_id', $user->id);
        Session::put('user_name', $user->username);
        Session::put('user_role', $user->role);

        return redirect('/')->with('success', 'Đăng ký thành công');
    }

    public function logout()
    {
        Session::forget(['user_id', 'user_name', 'user_role']);
        return redirect('/')->with('success', 'Đăng xuất thành công');
    }
} 