@extends('layouts.admin')

@section('title', 'Duyệt yêu cầu thuê thiết bị')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Duyệt yêu cầu thuê thiết bị</h1>
    </div>

    <div class="card shadow mb-4">
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
                            <th>Hình ảnh</th>
                            <th>Người thuê</th>
                            <th>Thiết bị</th>
                            <th>Số lượng</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rentals as $rental)
                            <tr>
                                <td>{{ $rental->booking_id }}</td>
                                <td>
                                    @if($rental->equipment->image)
                                        <img src="{{ asset('storage/' . $rental->equipment->image) }}" 
                                             alt="{{ $rental->equipment->name }}" 
                                             class="img-thumbnail" 
                                             style="max-width: 100px;">
                                    @else
                                        <span class="text-muted">Không có ảnh</span>
                                    @endif
                                </td>
                                <td>{{ $rental->user->username }}</td>
                                <td>{{ $rental->equipment->name }}</td>
                                <td>{{ $rental->quantity }}</td>
                                <td>{{ $rental->start_date->format('d/m/Y') }}</td>
                                <td>{{ $rental->end_date->format('d/m/Y') }}</td>
                                <td>
                                    @switch($rental->status)
                                        @case('pending')
                                            <span class="badge bg-warning">Chờ duyệt</span>
                                            @break
                                        @case('approved')
                                            <span class="badge bg-success">Đã duyệt</span>
                                            @break
                                        @case('rejected')
                                            <span class="badge bg-danger">Đã từ chối</span>
                                            @break
                                        @case('returned')
                                            <span class="badge bg-success">Đã trả</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('admin.equipment.rental.detail', $rental->booking_id) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Chi tiết
                                    </a>
                                    @if($rental->status == 'pending')
                                        <form action="{{ route('admin.equipment.rental.approve', $rental->booking_id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i> Duyệt
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.equipment.rental.reject', $rental->booking_id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-times"></i> Từ chối
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Không có yêu cầu thuê nào</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $rentals->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 