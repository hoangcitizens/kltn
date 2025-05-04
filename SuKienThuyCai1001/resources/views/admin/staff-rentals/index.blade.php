@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Quản lý đơn thuê nhân sự</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nhân sự</th>
                            <th>Người thuê</th>
                            <th>Ngày thuê</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rentals as $rental)
                            <tr>
                                <td>{{ $rental->id }}</td>
                                <td>{{ $rental->staff->name }}</td>
                                <td>{{ $rental->user->username ?? ''}}</td>
                                <td>{{ $rental->rental_date->format('d/m/Y') }}</td>
                                <td>{{ $rental->quantity }}</td>
                                <td>{{ number_format($rental->total_price) }} VNĐ</td>
                                <td>
                                    @if($rental->status === 'pending')
                                        <span class="badge bg-warning">Chờ duyệt</span>
                                    @elseif($rental->status === 'approved')
                                        <span class="badge bg-success">Đã duyệt</span>
                                    @else
                                        <span class="badge bg-danger">Đã từ chối</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.staff-rentals.show', $rental->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($rental->status === 'pending')
                                        <form action="{{ route('admin.staff-rentals.approve', $rental->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.staff-rentals.reject', $rental->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.staff-rentals.destroy', $rental->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Không có đơn thuê nào</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $rentals->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 