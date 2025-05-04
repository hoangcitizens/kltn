@extends('Sukien.layouts.noidung')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Danh sách đơn đặt thuê</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Thiết bị</th>
                                    <th>Người đặt</th>
                                    <th>Ngày đặt</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->booking_id }}</td>
                                        <td>{{ $booking->equipment->name }}</td>
                                        <td>{{ $booking->user->username }}</td>
                                        <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $booking->status == 'pending' ? 'warning' : ($booking->status == 'approved' ? 'success' : 'danger') }}">
                                                {{ $booking->status == 'pending' ? 'Đang chờ' : ($booking->status == 'approved' ? 'Đã duyệt' : 'Từ chối') }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('bookings.show', $booking->booking_id) }}" class="btn btn-sm btn-info">Xem</a>
                                            @if($booking->status == 'pending')
                                                <a href="{{ route('bookings.edit', $booking->booking_id) }}" class="btn btn-sm btn-primary">Sửa</a>
                                                <form action="{{ route('bookings.destroy', $booking->booking_id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn đặt thuê này?')">Xóa</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Không có đơn đặt thuê nào.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 