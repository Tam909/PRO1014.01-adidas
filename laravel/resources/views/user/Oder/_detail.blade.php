<p><strong>Mã đơn:</strong> #{{ $order->id_order }}</p>
<p><strong>Ngày đặt:</strong> {{ \Carbon\Carbon::parse($order->create_at)->format('d/m/Y H:i') }}</p>
<p><strong>Trạng thái:</strong>
    @switch($order->status_order)
        @case(0) <span class="badge bg-warning text-dark">Đang chờ xác nhận</span> @break
        @case(1) <span class="badge bg-primary">Đơn hàng đang được xử lý</span> @break
        @case(2) <span class="badge bg-info text-dark">Đơn hàng đang vận chuyển</span> @break
        @case(3) <span class="badge bg-info">Đơn hàng đang giao</span> @break
        @case(4) <span class="badge bg-success">Đã giao thành công</span> @break
        @case(5) <span class="badge bg-success">Đã hoàn tất</span> @break
        @case(6) <span class="badge bg-danger">Đã hủy</span> @break
        @case(7) <span class="badge bg-warning text-dark">Đang hoàn tiền</span> @break
        @default <span class="badge bg-secondary">Không xác định</span>
    @endswitch
</p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->orderItems as $item)
        <tr>
            <td><img src="{{ asset('storage/' . $item->product->img) }}" width="50"></td>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->price) }}đ</td>
            <td>{{ number_format($item->price * $item->quantity) }}đ</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="text-end fw-bold text-primary">
    Tổng tiền: {{ number_format($order->orderItems->sum(fn($i) => $i->price * $i->quantity)) }}đ
</div>
@if ($order->status_order == 4)
    <form action="{{ route('user.order.confirmReceive', $order->id_order) }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-success">
            Xác nhận đã nhận hàng
        </button>
    </form>
@endif
<!-- Thông tin chi tiết đơn hàng bạn đang có ở đây -->

<hr>

@if ($order->status_order == 0)
    <form action="{{ route('user.order.cancel', $order->id_order) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này?');">
        @csrf
        <button type="submit" class="btn btn-danger w-100">🛑 Hủy đơn hàng</button>
    </form>
@endif

