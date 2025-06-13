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
                        <th>Xác nhận</th>
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
                            @if($order->status_order == 0)
                            <span class="badge bg-warning text-dark">⏳ Chờ xác nhận</span>
                            @elseif($order->status_order == 1)
                            <span class="badge bg-primary">✅  Đã xác nhận - Chờ xử lý</span>
                            @elseif($order->status_order == 2)
                            <span class="badge bg-info text-dark">📦 Đang chuẩn bị hàng</span>
                            @elseif($order->status_order == 3)
                            <span class="badge bg-info text-dark">🚚 Đang giao hàng</span>
                            @elseif($order->status_order == 4)
                            <span class="badge bg-success">📬  Đã giao thành công</span>
                            @elseif($order->status_order == 5)
                            <span class="badge bg-success">🏁 Hoàn thành</span>
                            @elseif($order->status_order == 6)
                            <span class="badge bg-danger">❌ Đã hủy</span>
                            @elseif($order->status_order == 7)
                            <span class="badge bg-warning text-dark">💸 Đang hoàn tiền</span>
                            @else
                            <span class="badge bg-secondary">❓ Trạng thái không xác định</span>
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
                        <td>
                            @if($order->status_order != 5)
                            <form action="{{ route('orders.confirm', $order->id_order) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">
                                    ✅ Xác nhận
                                </button>
                            </form>
                            @else
                            <span class="text-success fw-semibold">✔ Đã xác nhận</span>
                            @endif
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
