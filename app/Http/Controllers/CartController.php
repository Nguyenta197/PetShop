<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cart = session('cart', []);
        return view('client.cart.index', compact('cart'));
    }

    // Thêm sản phẩm vào giỏ
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('client.cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');

    }

    // Cập nhật số lượng sản phẩm
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ((int) $request->quantity <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity'] = (int) $request->quantity;
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('client.cart.index')->with('success', 'Cập nhật giỏ hàng thành công.');
    }

    // Xoá sản phẩm khỏi giỏ
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Đã xoá sản phẩm khỏi giỏ.');
    }

    // Hiển thị form thanh toán
    public function checkoutForm()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        return view('client.cart.checkout', compact('cart', 'total'));
    }

    // Xử lý thanh toán
    public function processCheckout(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        // Tạo đơn hàng
        $order = Order::create([
            'user_id' => Auth::id(),
            'fullname' => $request->fullname,
            'address' => $request->address,
            'phone' => $request->phone,
            'total' => $total,
            'status' => 'pending',
        ]);

        // Tạo các mục trong đơn hàng
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        // Xóa giỏ hàng sau khi đặt hàng
        session()->forget('cart');
        return redirect()->route('client.cart.index')->with('success', 'Đặt hàng thành công!');
    }

    // Mua ngay và chuyển đến thanh toán
    public function buyNow(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Kiểm tra nếu giỏ hàng chưa có, khởi tạo giỏ hàng
        $cart = session()->get('cart', []);

        // Thêm sản phẩm vào giỏ hàng với số lượng = 1
        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'image' => $product->image,
        ];

        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);

        // Chuyển hướng đến trang thanh toán
        return redirect()->route('cart.checkout.form')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng, hãy hoàn tất thanh toán.');
    }
}
