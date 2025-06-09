<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders');
    }

   public function showCart()
{
    $cart = Cart::with(['cartDetail.product'])
        ->where('id_user', auth()->id())
        ->first();

    return view('user.Cart.cart', compact('cart'));
}

    public function addtoCart(Request $request, $productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.');
        }

        $userId = Auth::id();
        $product =Product::findOrFail($productId);

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
        }else{
            CartDetail::create([
                'id_cart' => $cart->id_cart,
                'id_pro' => $product->id,
                'quantity' => $quantity,
                'money' => $product->price,
                'total_money' => $product->price * $quantity,
            ]);
        }
        $cart->total_money =CartDetail::where('id_cart', $cart->id_cart)
            ->sum('total_money');
            $cart->save();
            return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    public function destroy($id_detail){
        $detail = CartDetail::findOrFail($id_detail);

        $cart = $detail->cart;
        $cart->total_money -= $detail->total_money;
        $cart->save();
        $detail->delete();
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }
}
