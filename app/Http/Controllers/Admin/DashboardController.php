<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
// use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
{
    $totalProducts = Product::count();
    $totalCategories = Category::count();
    $totalOrders = 0;

    // Nếu bạn đã có bảng orders
    // if (class_exists(\App\Models\Order::class)) {
    //     $totalOrders = Order::count();
    // }

    return view('admin.dashboard', compact(
        'totalProducts',
        'totalCategories',
        'totalOrders'
    ));
}
}
