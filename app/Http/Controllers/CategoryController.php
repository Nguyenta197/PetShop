<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //querybuider
        $query = Category::query()->orderBy('id', 'desc');
        if($request->has('search')){
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $categories = $query->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //querybuider
        Category::create($request->validated());
        return redirect()->route('admin.categories.index')->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //querybuider
        $category = Category::query()->where('id', $id)->first();
        return view('admin.categories.show', compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //querybuider
        $category = Category::query()->where('id', $id)->first();
        return view('admin.categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        Category::query()->where('id', $id)->update($request->validated());
        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::query()->where('id', $id)->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Xóa thành công');
    }
}
