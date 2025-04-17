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
    public function home(Request $request)
{
    $query = Product::query();

    // Tìm kiếm
    if ($request->filled('keyword')) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
    }

    // Lọc theo giá
    if ($request->filled('price_filter')) {
        switch ($request->price_filter) {
            case 'under_1m':
                $query->where('price', '<', 1000000);
                break;
            case '1m_3m':
                $query->whereBetween('price', [1000000, 3000000]);
                break;
            case 'over_3m':
                $query->where('price', '>', 3000000);
                break;
        }
    }

    $products = $query->paginate(6);
    return view('client.home', compact('products'));
}


    public function listClient(Request $request)
    {
        $query = Product::query();

        // Tìm kiếm theo tên sản phẩm
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // Lọc theo khoảng giá
        if ($request->filled('price_filter')) {
            switch ($request->price_filter) {
                case 'under_1m':
                    $query->where('price', '<', 1000000);
                    break;
                case '1m_3m':
                    $query->whereBetween('price', [1000000, 3000000]);
                    break;
                case 'over_3m':
                    $query->where('price', '>', 3000000);
                    break;
            }
        }

        $products = $query->paginate(6)->withQueryString(); // Giữ query khi phân trang

        return view('client.list', compact('products'));
    }

    public function clientDetail($id)
    {
        $product = Product::findOrFail($id);

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(5)
            ->get();

        return view('client.detail', compact('product', 'relatedProducts'));
    }
    // Trong CartController
    

    public function create()
    {
        // Lấy tất cả danh mục (kể cả đang dừng hoạt động)
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    // Xử lý lưu sản phẩm
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            // thêm các field khác nếu có
        ]);

        // Lấy danh mục tương ứng
        $category = Category::find($validated['category_id']);

        // Nếu danh mục không tồn tại hoặc đã dừng hoạt động
        if (!$category || $category->status == 0) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Danh mục này đã dừng hoạt động. Vui lòng chọn danh mục khác!');
        }

        // Tạo sản phẩm
        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
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
