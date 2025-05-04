@extends('Sukien.layouts.main')

@section('content')
<div class="container mt-5">
    <h2>Dashboard</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Tổng số người dùng</h5>
                    <h2>{{ $totalUsers }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Tổng số đơn đặt</h5>
                    <h2>{{ $totalBookings }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Tổng số thiết bị</h5>
                    <h2>{{ $totalEquipment }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h4>Đơn đặt gần đây</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Người dùng</th>
                            <th>Dịch vụ</th>
                            <th>Ngày đặt</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->user->username }}</td>
                                <td>{{ $booking->service->name }}</td>
                                <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @switch($booking->status)
                                        @case('pending')
                                            <span class="badge bg-warning">Đang chờ</span>
                                            @break
                                        @case('confirmed')
                                            <span class="badge bg-success">Đã xác nhận</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge bg-danger">Đã hủy</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">{{ $booking->status }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-sm btn-info">Xem chi tiết</a>
                                    @if($booking->status == 'pending')
                                        <form action="{{ route('bookings.confirm', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success">Xác nhận</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Chưa có đơn đặt nào</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 