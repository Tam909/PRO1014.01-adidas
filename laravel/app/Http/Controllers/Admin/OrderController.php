<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderItem;
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

        switch ($order->status_order) {
            case 0:
                $order->status_order = 1; // Chờ xác nhận → Đã xác nhận
                $message = 'Đơn hàng đã được xác nhận.';
                break;
            case 1:
                $order->status_order = 2; //Chờ giao hàng
                $message = 'Đơn hàng đang chờ giao.';
                break;
            case 2:
                $order->status_order = 3; // Chờ giao hàng → Đang giao hàng
                $message = 'Đơn hàng đang được giao.';
                break;
            case 3:
                $order->status_order = 4; // Đang giao hàng → Đã nhận hàng
                $message = 'Khách hàng đã nhận được hàng.';
                break;
            case 4:
                $order->status_order = 5; // Đã nhận hàng → Hoàn thành
                $message = 'Đơn hàng đã hoàn thành.';
                break;
            default:
                $message = 'Đơn hàng đã được xử lý xong hoặc không thể xác nhận tiếp.';
                break;
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
