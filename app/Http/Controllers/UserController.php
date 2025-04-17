<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Danh sách user
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // Form tạo user
    public function create()
    {
        return view('admin.users.create');
    }

    // Lưu user mới
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect()->route('users.index')->with('success', 'Thêm tài khoản thành công!');
    }

    // Form chỉnh sửa user
    // public function edit(User $user)
    // {
    //     return view('admin.users.edit', compact('user'));
    // }

    // // Cập nhật user
    // public function update(UserRequest $request, User $user)
    // {
    //     $data = $request->validated();

    //     if ($request->filled('password')) {
    //         $data['password'] = Hash::make($data['password']);
    //     } else {
    //         unset($data['password']);
    //     }

    //     $user->update($data);

    //     return redirect()->route('users.index')->with('success', 'Cập nhật tài khoản thành công!');
    // }

    // // Xoá user
    // public function destroy(User $user)
    // {
    //     $user->delete();
    //     return redirect()->route('users.index')->with('success', 'Xoá tài khoản thành công!');
    // }
}
