@extends('user.layoutUser')

@section('title', 'Trang Liên Hệ')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h2 class="mb-0">Liên Hệ Với Chúng Tôi</h2>
                </div>
                <div class="card-body p-4">
                    {{-- Hiển thị thông báo thành công (flash message từ session) --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Hiển thị thông báo lỗi (ví dụ: nếu có lỗi trong quá trình gửi mail, mặc dù giờ đã bỏ) --}}
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Hiển thị LỖI VALIDATION từ Laravel --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf {{-- BẮT BUỘC: Laravel CSRF protection --}}

                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và Tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            {{-- old('name') giúp giữ lại giá trị đã nhập nếu có lỗi validation --}}
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}">
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Nội dung tin nhắn <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Gửi Tin Nhắn</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection