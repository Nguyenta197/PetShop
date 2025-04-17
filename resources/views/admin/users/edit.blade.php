@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa tài khoản</h2>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.users.form', ['user' => $user])
    </form>
</div>
@endsection
