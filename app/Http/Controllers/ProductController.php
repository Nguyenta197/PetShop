<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');
        if($request->has('search')){
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $products = $query->paginate(10);
        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::query()->where('status',1)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('image')) {
            $data['image'] = Storage::putFile('public/products', $request->image);
        }
        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        $products = Product::query()->where('id', $product->id)->first();
        $categories = Category::query()->where('status',1)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        if($request->hasFile('image')) {
            $data['image'] = Storage::putFile('public/products', $request->image);
        }
        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete($product);
        return redirect()->route('products.index')->with('success', 'Xóa thành công');
    }
}
