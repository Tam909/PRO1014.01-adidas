<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\Product;
use App\Models\Varianti;
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

   public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $currentStatus = $order->status_order;
    $newStatus = (int)$request->input('status_order');

    // Xử lý hủy trước
    if ($newStatus == 6 && $currentStatus == 5) {
        return back()->with('error', 'Đơn hàng đã giao thành công, không thể hủy.');
    }
        if ($newStatus == 6) {
        $order->status_order = 6;
        $order->save();
        return back()->with('success', 'Đơn hàng đã được hủy.');
    }


    // Check không nhảy cóc trạng thái (chỉ cho phép +1)
    if ($newStatus != $currentStatus && $newStatus != $currentStatus + 1) {
        return back()->with('error', 'Không thể chuyển trạng thái.');
    }

    $order->status_order = $newStatus;
    $order->save();

    return back()->with('success', 'Cập nhật trạng thái thành công.');
}




    public function showCart()
    {
        $user = Auth::user();
        $cart = Cart::with(['cartDetail.varianti.color', 'cartDetail.varianti.size','cartDetail.product'])
           
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

    // 🆕 Lấy color_id và size_id từ form
    $colorId = $request->input('color_id');
    $sizeId = $request->input('size_id');
    $quantity = $request->input('quantity', 1);

    // 🆕 Tìm variant phù hợp
    $variant = Varianti::where('id_pro', $productId)
        ->where('id_color', $colorId)
        ->where('id_size', $sizeId)
        ->first();

    if (!$variant) {
        return redirect()->back()->with('error', 'Không tìm thấy biến thể phù hợp với màu và size bạn chọn.');
    }

    $variantId = $variant->id_var;
    $price = $variant->price;

    // 🛒 Tìm hoặc tạo giỏ hàng
    $cart = Cart::firstOrCreate(
        ['id_user' => $userId, 'status' => 0],
        ['total_money' => 0]
    );

    // 🧾 Kiểm tra nếu sản phẩm đã có trong giỏ thì cộng thêm
    $cartDetail = CartDetail::where('id_cart', $cart->id_cart)
        ->where('id_pro', $productId)
        ->where('varianti_id', $variantId)
        ->first();

    if ($cartDetail) {
        $cartDetail->quantity += $quantity;
        $cartDetail->total_money = $cartDetail->quantity * $price;
        $cartDetail->save();
    } else {
        CartDetail::create([
            'id_cart' => $cart->id_cart,
            'id_pro' => $product->id,
            'varianti_id' => $variantId,
            'quantity' => $quantity,
            'money' => $price,
            'total_money' => $price * $quantity,
        ]);
    }

    // 🔄 Cập nhật tổng tiền giỏ hàng
    $cart->total_money = CartDetail::where('id_cart', $cart->id_cart)->sum('total_money');
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
