@extends('Sukien.layouts.noidung')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Chi tiết đơn đặt thuê</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5>Thông tin thiết bị</h5>
                            @if($booking->equipment->image)
                                <img src="{{ asset('storage/' . $booking->equipment->image) }}" 
                                     alt="{{ $booking->equipment->name }}" 
                                     class="img-fluid rounded mb-3" 
                                     style="max-height: 200px; width: auto;">
                            @endif
                            <p><strong>Tên thiết bị:</strong> {{ $booking->equipment->name }}</p>
                            <p><strong>Mô tả:</strong> {!! $booking->equipment->description !!}</p>
                            <p><strong>Giá thuê/ngày:</strong> {{ number_format($booking->equipment->price) }} VNĐ</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Thông tin đặt thuê</h5>
                            <p><strong>Ngày bắt đầu:</strong> {{ date('d/m/Y', strtotime($booking->start_date)) }}</p>
                            <p><strong>Ngày kết thúc:</strong> {{ date('d/m/Y', strtotime($booking->end_date)) }}</p>
                            <p><strong>Số lượng:</strong> {{ $booking->quantity }}</p>
                            <p><strong>Tổng tiền:</strong> {{ number_format($booking->total_price) }} VNĐ</p>
                            <p>
                                <strong>Trạng thái:</strong>
                                <span class="badge bg-{{ $booking->status == 'pending' ? 'warning' : ($booking->status == 'approved' ? 'success' : 'danger') }}">
                                    {{ $booking->status == 'pending' ? 'Đang chờ' : ($booking->status == 'approved' ? 'Đã duyệt' : 'Từ chối') }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h5>Thông tin người đặt</h5>
                            <p><strong>Họ tên:</strong> {{ $booking->user->username }}</p>
                            <p><strong>Email:</strong> {{ $booking->user->email }}</p>
                            <p><strong>Số điện thoại:</strong> {{ $booking->user->phone }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        @if($booking->status == 'pending')
                            <form action="{{ route('bookings.cancel', $booking->booking_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-times"></i> Hủy đơn
                                </button>
                            </form>
                        @endif

                        @if($booking->status == 'approved')
                            <form action="{{ route('bookings.return', $booking->booking_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-undo"></i> Trả thiết bị
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 