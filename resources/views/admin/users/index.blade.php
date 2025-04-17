@extends('admin.layouts.app')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success')}}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-error">
        {{ session('error')}}
    </div>
@endif
@section('title','Danh sách tài khoản')
@section('content')
<div class="container">
    <h2>Danh sách tài khoản</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Thêm tài khoản</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $user)
            <tr>
                <td>{{ $users->firstItem() + $key }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection
