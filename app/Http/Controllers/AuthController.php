<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Phân quyền chuyển trang
            if ($user->role === 'admin') {
                return redirect('/categories');
            } elseif ($user->role === 'client') {
                return redirect('/list');
            }
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->withInput();
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        // Validate dữ liệu nhập vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Tạo user mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // <-- đúng theo migration của bạn
        ]);


        // Đăng nhập luôn sau khi đăng ký (tùy chọn)
        Auth::login($user);

        return redirect('/list')->with('success', 'Đăng ký thành công!');
    }
}
