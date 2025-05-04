@extends('Sukien.layouts.noidung')

@section('content')
<div class="container mt-5">
    <h2>Đơn đặt của tôi</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Dịch vụ</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_id }}</td>
                        <td>{{ $booking->equipment->name ?? ''}}</td>
                        <td>{{ date('d/m/Y', strtotime($booking->start_date)) }}</td>
                        <td>
                            @switch($booking->status)
                                @case('pending')
                                    <span class="badge bg-warning">Đang chờ</span>
                                    @break
                                @case('approved')
                                    <span class="badge bg-success">Đã xác nhận</span>
                                    @break
                                @case('rejected')
                                    <span class="badge bg-danger">Đã hủy</span>
                                    @break
                                @case('returned')
                                    <span class="badge bg-success">Đã trả hàng</span>
                                    @break
                                @default
                                    <span class="badge bg-secondary">{{ $booking->status }}</span>
                            @endswitch
                        </td>
                        <td>
                            <a href="{{ route('bookings.show', $booking->booking_id) }}" class="btn btn-sm btn-info">Xem chi tiết</a>
                            @if($booking->status == 'pending')
                                <form action="{{ route('bookings.cancel', $booking->booking_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn này?')">Hủy đơn</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Bạn chưa có đơn đặt nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $bookings->links() }}
    </div>
</div>
@endsection 