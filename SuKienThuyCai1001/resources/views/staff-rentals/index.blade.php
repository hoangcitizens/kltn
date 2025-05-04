@extends('Sukien.layouts.noidung')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Lịch sử thuê nhân sự</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($rentals->isEmpty())
                        <div class="alert alert-info">
                            Bạn chưa có yêu cầu thuê nhân sự nào.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Mã yêu cầu</th>
                                        <th>Nhân sự</th>
                                        <th>Ngày thuê</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rentals as $rental)
                                        <tr>
                                            <td>#{{ $rental->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($rental->staff->image)
                                                        <img src="{{ asset('storage/' . $rental->staff->image) }}" 
                                                             class="rounded me-2" 
                                                             alt="{{ $rental->staff->name }}"
                                                             style="width: 40px; height: 40px; object-fit: cover;">
                                                    @endif
                                                    <span>{{ $rental->staff->name }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $rental->rental_date->format('d/m/Y') }}</td>
                                            <td>{{ $rental->quantity }}</td>
                                            <td>{{ number_format($rental->total_price) }} VNĐ</td>
                                            <td>
                                                <span class="badge bg-{{ $rental->status === 'pending' ? 'warning' : ($rental->status === 'approved' ? 'success' : 'danger') }}">
                                                    {{ $rental->status === 'pending' ? 'Đang chờ' : ($rental->status === 'approved' ? 'Đã duyệt' : 'Đã từ chối') }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('staff.rentals.show', $rental->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> Xem
                                                </a>
                                                @if($rental->status === 'pending')
                                                    <form action="{{ route('staff.rentals.cancel', $rental->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Bạn có chắc chắn muốn hủy yêu cầu này?')">
                                                            <i class="fas fa-times"></i> Hủy
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('staff.rentals.destroy', $rental->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa yêu cầu này?')">
                                                            <i class="fas fa-trash"></i> Xóa
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $rentals->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 