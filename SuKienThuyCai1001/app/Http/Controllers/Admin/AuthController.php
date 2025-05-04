<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // if (Session::has('admin_id')) {
        //     return redirect()->route('admin.categories.index');
        // }
        return view('admin.auth.login');
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
            Session::put('admin_id', $user->user_id);
            Session::put('admin_name', $user->username);
            Session::put('admin_email', $user->email);
            Session::put('admin_role', $user->role);

            $categories = Category::orderBy('created_at', 'desc')->paginate(10);
            return view('admin.categories.index', compact('categories'));
        }

        return back()->with('error', 'Email hoặc mật khẩu không đúng');
    }

    public function logout()
    {
        // Xóa session admin
        Session::forget(['admin_id', 'admin_name', 'admin_email', 'admin_role']);

        return redirect()->route('admin.login');
    }
}
