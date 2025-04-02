@extends('layouts.app')
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
@section('title', 'Danh sách danh mục')
@section('content')

    <div class="container">
        <h2>Danh sách danh mục</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Thêm danh mục</a>
        <form method="get" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm danh mục"
                value ="{{ request()->search }}">
                <button type="onsubmit" class="btn btn-outline-secondary">Tim kiem</button>
            </div>
        </form>
        @extends('admin.layouts.app')

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @section('title','Danh sách danh mục')
        @section('content')
            <div class="container">
                <h2>Danh sách danh mục</h2>
                <a href="{{route('categories.create')}}" class="btn btn-primary">Thêm danh mục</a>
                <form method="get" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm danh mục ..."
                        value="{{request('search')}}">
                        <button type="submit" class="btn btn-outline-secondary">Tìm kiếm</button>
                    </div>
                </form>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $cate)
                            <tr>
                                <td>{{$cate->id}}</td>
                                <td>{{$cate->name}}</td>
                                <td>{{$cate->status ? "Hoạt động":"Tạm dừng"}}</td>
                                <td>
                                    <a href="{{route('categories.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
                                    <form action="{{route('categories.destroy',$cate->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$categories->links()}}
            </div>

        @endsection

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Ngày thêm</th>
                    <th>Ngày cập nhật</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td>{{ $category->status == 1 ? 'Hoạt động' : 'Tạm dừng'}}</td>
                        <td>
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary">Chi tiết</a>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick=" return confirm('Ban co chac muon xoa')" class="btn btn-danger">Xoa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
@endsection
