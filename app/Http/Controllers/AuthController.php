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
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role == 'admin') {
                // $request->session()->put('admin', true);
            return redirect()->intended('/categories');

            }

            return redirect()->intended('/list');

        }

        return back()->withErrors([
            'password' => 'Thông tin đăng nhập không chính xác.',
        ])->withInput($request->except('password'));
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
