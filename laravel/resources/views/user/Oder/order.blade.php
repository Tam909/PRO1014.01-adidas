@extends('user.layoutUser')

@section('title', 'Đơn hàng của tôi')

@section('content')
<h2 class="fw-bold mb-4">🛒 Đơn hàng của tôi</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th># Mã đơn</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th>Sản phẩm</th>
                        <th>Tổng tiền</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id_order }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->create_at)->format('d/m/Y') }}</td>
                        <td>
                            @switch($order->status_order)
                                @case(0) <span class="badge bg-warning text-dark">Đang chờ xác nhận</span> @break
                                @case(1) <span class="badge bg-primary">Đơn hàng đang được xử lý</span> @break
                                @case(2) <span class="badge bg-info text-dark">Đơn hàng đang vận chuyển</span> @break
                                @case(3) <span class="badge bg-info">Đơn hàng đang giao</span> @break
                                @case(4) <span class="badge bg-success">Đã giao thành công</span> @break
                                @case(5) <span class="badge bg-success">Đã nhận hàng</span> @break
                                @case(6) <span class="badge bg-danger">Đã hủy</span> @break
                                @case(7) <span class="badge bg-warning text-dark">Đang hoàn tiền</span> @break
                                @default <span class="badge bg-secondary">Không xác định</span>
                            @endswitch
                        </td>
                        <td class="text-start">
                            @foreach($order->orderItems as $item)
                            <div class="d-flex align-items-center mb-1">
                                <img src="{{ asset('storage/' . $item->product->img) }}" width="40" height="40" class="rounded shadow-sm me-2">
                                <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                            </div>
                            @endforeach
                        </td>
                        <td class="fw-bold text-primary">
                            {{ number_format($order->orderItems->sum(fn($i) => $i->price * $i->quantity)) }}đ
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary btn-show-detail" data-id="{{ $order->id_order }}">
                                Xem chi tiết
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="orderDetailModal" tabindex="-1" aria-labelledby="orderDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderDetailModalLabel">Chi tiết đơn hàng</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
      </div>
      <div class="modal-body">
        <div id="order-detail-content">
          <!-- Nội dung chi tiết sẽ load bằng AJAX -->
          <div class="text-center text-muted">Đang tải...</div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.btn-show-detail');
    buttons.forEach(btn => {
        btn.addEventListener('click', function() {
            const orderId = this.getAttribute('data-id');
            const modal = new bootstrap.Modal(document.getElementById('orderDetailModal'));
            document.getElementById('order-detail-content').innerHTML = '<div class="text-center text-muted">Đang tải...</div>';
            modal.show();

            fetch(`/my-orders/${orderId}/ajax`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('order-detail-content').innerHTML = html;
                })
                .catch(err => {
                    document.getElementById('order-detail-content').innerHTML = '<div class="text-danger">Đã xảy ra lỗi, vui lòng thử lại!</div>';
                });
        });
    });
});
</script>
@endpush
