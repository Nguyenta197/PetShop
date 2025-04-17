@extends('admin.layouts.app')
@section('title','Thêm tai khoan')
@section('content')
<div class="container">
    <h2>Thêm tài khoản</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        @include('admin.users.form', ['user' => null])
    </form>
</div>
@endsection
