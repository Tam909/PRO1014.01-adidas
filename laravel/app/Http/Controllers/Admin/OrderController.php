<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['orderItems.product'])
            ->orderBy('create_at', 'desc')
            ->paginate(10);

        session(['orders_page' => $request->get('page', 1)]);

        return view('admin.orders', compact('orders'));
    }

    public function confirm($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status_order == 0) {
            // Đang chờ → chuyển sang đang giao
            $order->status_order = 1;
            $message = 'Đơn hàng đang được giao.';
        } elseif ($order->status_order == 1) {
            // Đang giao → chuyển sang hoàn thành
            $order->status_order = 2;
            $message = 'Đơn hàng đã hoàn thành.';
        } else {
            $message = 'Đơn hàng đã được xử lý xong.';
        }

        $order->save();


        $page = session('orders_page', 1);


        return redirect()->route('orders.index', ['page' => $page])->with('success', $message);
    }


    public function showCart()
    {
        $user = Auth::user();
        $cart = Cart::with(['cartDetail.product'])
            // ->where('id_user', auth()->id())
            // ->first();
            ->where('id_user', $user->id)
            ->where('status', 0)
            ->first();

        return view('user.Cart.cart', compact('cart'));
    }

    public function addtoCart(Request $request, $productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.');
        }

        $userId = Auth::id();
        $product = Product::findOrFail($productId);

        $cart = Cart::firstOrCreate(
            ['id_user' => $userId, 'status' => 0],
            ['total_money' => 0]
        );

        $quantity = $request->input('quantity', 1);

        $cartDetail = CartDetail::where('id_cart', $cart->id)
            ->where('id_pro', $productId)
            ->first();

        if ($cartDetail) {
            $cartDetail->quantity += $quantity;
            $cartDetail->total_money = $cartDetail->quantity * $cartDetail->money;
            $cartDetail->save();
        } else {
            CartDetail::create([
                'id_cart' => $cart->id_cart,
                'id_pro' => $product->id,
                'quantity' => $quantity,
                'money' => $product->price,
                'total_money' => $product->price * $quantity,
            ]);
        }
        $cart->total_money = CartDetail::where('id_cart', $cart->id_cart)
            ->sum('total_money');
        $cart->save();
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    public function destroy($id_detail)
    {
        $detail = CartDetail::findOrFail($id_detail);

        $cart = $detail->cart;
        $cart->total_money -= $detail->total_money;
        $cart->save();
        $detail->delete();
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }
}
