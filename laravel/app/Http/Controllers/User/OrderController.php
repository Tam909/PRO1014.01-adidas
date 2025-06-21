<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;

class OrderController extends Controller
{
public function myOrders() {
    $orders = Order::with('orderItems.product')
                   ->where('user_id', auth()->id())
                   ->orderByDesc('create_at')
                   ->paginate(10);
    return view('user.Oder.order', compact('orders'));
}

public function showAjax($id)
{
    $order = Order::with('orderItems.product')->findOrFail($id);
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    return view('user.Oder._detail', compact('order'))->render();
}
public function confirmReceive($id)
{
    $order = Order::findOrFail($id);
    if ($order->status_order == 4) {
        $order->status_order = 5; //
        $order->save();
    }
    return redirect()->route('user.order.index')->with('success', 'Cảm ơn bạn đã xác nhận!');
}

    public function cancelOrder($id)
{
    $order = Order::where('id_order', $id)->where('user_id', auth()->id())->firstOrFail();

    if ($order->status_order != 0) {
        return back()->with('error', 'Chỉ có thể hủy đơn hàng đang chờ xác nhận.');
    }

    $order->status_order = 6; // Hủy đơn
    $order->save();

    return back()->with('success', 'Đơn hàng đã được hủy thành công.');
}

}