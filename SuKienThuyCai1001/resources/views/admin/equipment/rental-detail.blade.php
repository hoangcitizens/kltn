@extends('layouts.admin')

@section('title', 'Chi tiết yêu cầu thuê thiết bị')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chi tiết yêu cầu thuê thiết bị</h1>
        <a href="{{ route('admin.equipment.rentals') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
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

            <div class="row">
                <div class="col-md-6">
                    <h5>Thông tin người thuê</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Họ tên</th>
                            <td>{{ $rental->user->username }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $rental->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Số điện thoại</th>
                            <td>{{ $rental->user->phone ?? 'Chưa cập nhật' }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h5>Thông tin thiết bị</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Tên thiết bị</th>
                            <td>{{ $rental->equipment->name }}</td>
                        </tr>
                        <tr>
                            <th>Hình ảnh</th>
                            <td>
                                @if($rental->equipment->image)
                                    <img src="{{ asset('storage/' . $rental->equipment->image) }}" 
                                         alt="{{ $rental->equipment->name }}" 
                                         class="img-fluid rounded" 
                                         style="max-height: 300px;">
                                @else
                                    <span class="text-muted">Không có ảnh</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Số lượng thuê</th>
                            <td>{{ $rental->quantity }}</td>
                        </tr>
                        <tr>
                            <th>Giá thuê/ngày</th>
                            <td>{{ number_format($rental->equipment->price) }} VNĐ</td>
                        </tr>
                        <tr>
                            <th>Tổng tiền</th>
                            <td>{{ number_format($rental->total_price) }} VNĐ</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <h5>Thông tin thuê</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Ngày bắt đầu</th>
                            <td>{{ $rental->start_date->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Ngày kết thúc</th>
                            <td>{{ $rental->end_date->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Số ngày thuê</th>
                            <td>{{ $rental->start_date->diffInDays($rental->end_date) }} ngày</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
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
                                @endswitch
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h5>Ghi chú</h5>
                    <div class="border p-3">
                        {{ $rental->notes ?? 'Không có ghi chú' }}
                    </div>
                </div>
            </div>

            <div class="mt-4">
                @if($rental->status == 'pending')
                    <form action="{{ route('admin.equipment.rental.approve', $rental->booking_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Duyệt đơn
                        </button>
                    </form>
                    <form action="{{ route('admin.equipment.rental.reject', $rental->booking_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times"></i> Từ chối
                        </button>
                    </form>
                @endif

                @if($rental->status == 'approved')
                    <form action="{{ route('admin.equipment.rental.return', $rental->booking_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-undo"></i> Đánh dấu đã trả
                        </button>
                    </form>
                @endif

                <a href="{{ route('admin.equipment.rentals') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 