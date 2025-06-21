@extends('admin.layout')

@section('title', 'Quản lý đơn hàng')

@section('content')
<h2 class="mb-4 fw-bold text-primary">🛒 Danh sách đơn hàng</h2>

@if (session('success'))
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;">
    <div class="toast align-items-center text-white bg-success border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Đóng"></button>
        </div>
    </div>
</div>
@endif

@if(session('error'))
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;">
    <div class="toast align-items-center text-white bg-danger border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Đóng"></button>
        </div>
    </div>
</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th># Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th>Chi tiết</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="fw-bold text-primary">#{{ $order->id_order }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->tel }}</td>
                        <td class="text-start">{{ $order->shipping_address }}</td>
                        <td>
                            <form action="{{ route('orders.updateStatus', $order->id_order) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status_order" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="0" {{ $order->status_order == 0 ? 'selected' : '' }}>⏳ Chờ xác nhận</option>
                                    <option value="1" {{ $order->status_order == 1 ? 'selected' : '' }}>✅ Đã xác nhận </option>
                                    <option value="2" {{ $order->status_order == 2 ? 'selected' : '' }}>📦 Đang chuẩn bị hàng</option>
                                    <option value="3" {{ $order->status_order == 3 ? 'selected' : '' }}>🚚 Đang giao hàng</option>
                                    <option value="4" {{ $order->status_order == 4 ? 'selected' : '' }}>📬 Đã giao thành công</option>
                                    <option value="5" {{ $order->status_order == 5 ? 'selected' : '' }}>🏁 Hoàn thành</option>
                                    <option value="6" {{ $order->status_order == 6 ? 'selected' : '' }}>❌ Đã hủy</option>
                                    <option value="7" {{ $order->status_order == 7 ? 'selected' : '' }}>💸 Đang hoàn tiền</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            @if($order->status_order == 4)
                            <span class="badge bg-success">Đã thanh toán</span>
                            @else
                            <span class="badge bg-warning text-dark">Chưa thanh toán</span>
                            @endif
                        </td>



                        <td>{{ \Carbon\Carbon::parse($order->create_at)->format('d/m/Y H:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalOrder{{ $order->id_order }}">
                                <i class="bi bi-eye"></i> Xem
                            </button>

                            <div class="modal fade" id="modalOrder{{ $order->id_order }}" tabindex="-1" aria-labelledby="modalLabel{{ $order->id_order }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content shadow-lg">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">
                                                🧾 Chi tiết đơn hàng <strong>#{{ $order->id_order }}</strong>
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Đóng"></button>
                                        </div>

                                        <div class="modal-body px-4">
                                            <!-- Thông tin khách hàng -->
                                            <div class="mb-3 text-start">
                                                <h6 class="fw-bold text-primary">👤 Thông tin khách hàng</h6>
                                                <p class="mb-1"><strong>Họ tên:</strong> {{ $order->name }}</p>
                                                <p class="mb-1"><strong>📞 SĐT:</strong> {{ $order->tel }}</p>
                                                <p class="mb-0"><strong>📍 Địa chỉ:</strong> {{ $order->shipping_address }}</p>
                                            </div>

                                            <hr>

                                            <!-- Danh sách sản phẩm -->
                                            <h6 class="fw-bold text-primary mb-3">🛍️ Sản phẩm trong đơn hàng</h6>
                                            <div class="table-responsive">
                                                <table class="table table-bordered align-middle text-center">
                                                    <thead class="table-light">
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
                                                            <td>
                                                                <img src="{{ asset('storage/' . $item->product->img) }}" width="70" height="70" class="rounded shadow-sm">
                                                            </td>
                                                            <td>{{ $item->product->name }}</td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>{{ number_format($item->price) }}đ</td>
                                                            <td class="text-success fw-bold">{{ number_format($item->price * $item->quantity) }}đ</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Phân trang --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection