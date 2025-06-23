<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function showForm()
    {
        $user = Auth::user();

        $cart = Cart::with(['cartDetail.product'])
            ->where('id_user', $user->id)
            ->where('status', 0)
            ->first();

        return view('user.Oder.checkout', compact('user', 'cart'));
    }
    public function success()
    {
        return view('user.Oder.thanhcong');
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string|min:10',
            'address' => 'required|string',
            'payment' => 'required|string',
        ]);

        $user = Auth::user();

        $cart = Cart::with('cartDetail.product')
            ->where('id_user', $user->id)
            ->where('status', 0)
            ->first();

        if (!$cart || $cart->cartDetail->isEmpty()) {
            return back()->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $totalMoney = $cart->cartDetail->sum(function ($item) {
            return $item->quantity * $item->money;
        });

        // Tạo đơn hàng
        $order = Order::create([
            'user_id'          => $user->id,
            'id_promotion'     => null,
            'name'             => $request->name,
            'tel'              => $request->phone,
            'shipping_address' => $request->address,
            'status_order'     => 0,
            'payment'          => $request->payment,
            'total_money'      => $totalMoney,
            'total_amount'     => $cart->cartDetail->sum('quantity'),
            'create_at'        => Carbon::now(),
            'update_at'        => Carbon::now(),
        ]);


        foreach ($cart->cartDetail as $item) {
            OrderItem::create([
                'order_id'    => $order->id_order,
                'product_id'  => $item->product->id,
                'quantity'    => $item->quantity,
                'price'       => $item->money,
                'total_money' => $item->quantity * $item->money,
            ]);
        }

        $cart->cartDetail()->delete();
        $cart->delete();

        $cart->status = 1;
        $cart->save();

        return back()->with('success', 'Đặt hàng thành công!');
    }
}
