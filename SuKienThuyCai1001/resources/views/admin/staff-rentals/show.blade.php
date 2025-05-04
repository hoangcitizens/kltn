@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Chi tiết đơn thuê nhân sự</h3>
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

            <div class="row">
                <div class="col-md-6">
                    <h4>Thông tin nhân sự</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>Tên nhân sự:</th>
                            <td>{{ $rental->staff->name }}</td>
                        </tr>
                        <tr>
                            <th>Giá thuê:</th>
                            <td>{{ number_format($rental->staff->price) }} VNĐ/ngày</td>
                        </tr>
                        <tr>
                            <th>Mô tả:</th>
                            <td>{{ $rental->staff->description }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h4>Thông tin đơn thuê</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>ID đơn thuê:</th>
                            <td>{{ $rental->id }}</td>
                        </tr>
                        <tr>
                            <th>Người thuê:</th>
                            <td>{{ $rental->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Ngày thuê:</th>
                            <td>{{ $rental->rental_date->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Số lượng:</th>
                            <td>{{ $rental->quantity }}</td>
                        </tr>
                        <tr>
                            <th>Tổng tiền:</th>
                            <td>{{ number_format($rental->total_price) }} VNĐ</td>
                        </tr>
                        <tr>
                            <th>Trạng thái:</th>
                            <td>
                                @if($rental->status == 'pending')
                                    <span class="badge badge-warning">Chờ duyệt</span>
                                @elseif($rental->status == 'approved')
                                    <span class="badge badge-success">Đã duyệt</span>
                                @else
                                    <span class="badge badge-danger">Đã từ chối</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Ghi chú:</th>
                            <td>{{ $rental->notes ?? 'Không có ghi chú' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                @if($rental->status == 'pending')
                    <form action="{{ route('admin.staff-rentals.approve', $rental->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Duyệt đơn
                        </button>
                    </form>
                    <form action="{{ route('admin.staff-rentals.reject', $rental->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times"></i> Từ chối
                        </button>
                    </form>
                @endif
                <a href="{{ route('admin.staff.rentals') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 