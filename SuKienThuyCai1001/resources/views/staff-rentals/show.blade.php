@extends('Sukien.layouts.noidung')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Chi tiết yêu cầu thuê nhân sự</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            @if($rental->staff->image)
                                <img src="{{ asset('storage/' . $rental->staff->image) }}" 
                                     class="img-fluid rounded mb-3" 
                                     alt="{{ $rental->staff->name }}"
                                     style="max-height: 200px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/default-staff.jpg') }}" 
                                     class="img-fluid rounded mb-3" 
                                     alt="Default staff image"
                                     style="max-height: 200px; object-fit: cover;">
                            @endif
                        </div>
                        <div class="col-md-8 text-center text-md-start">
                            <h4 class="card-title mb-3">{{ $rental->staff->name }}</h4>
                            <p class="card-text mb-2">
                                <strong>Ngày thuê:</strong> {{ $rental->rental_date->format('d/m/Y') }}
                            </p>
                            <p class="card-text mb-2">
                                <strong>Số lượng:</strong> {{ $rental->quantity }}
                            </p>
                            <p class="card-text mb-2">
                                <strong>Tổng tiền:</strong> {{ number_format($rental->total_price) }} VNĐ
                            </p>
                            <p class="card-text mb-2">
                                <strong>Trạng thái:</strong>
                                <span class="badge bg-{{ $rental->status === 'pending' ? 'warning' : ($rental->status === 'approved' ? 'success' : 'danger') }}">
                                    {{ $rental->status === 'pending' ? 'Đang chờ' : ($rental->status === 'approved' ? 'Đã duyệt' : 'Đã từ chối') }}
                                </span>
                            </p>
                        </div>
                    </div>

                    @if($rental->notes)
                        <div class="mb-4">
                            <h5>Ghi chú</h5>
                            <p class="card-text">{{ $rental->notes }}</p>
                        </div>
                    @endif

                    <div class="d-flex gap-2">
                        @if($rental->status === 'pending')
                            <form action="{{ route('staff.rentals.cancel', $rental->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning" onclick="return confirm('Bạn có chắc chắn muốn hủy yêu cầu này?')">
                                    Hủy yêu cầu
                                </button>
                            </form>
                            <form action="{{ route('staff.rentals.destroy', $rental->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa yêu cầu này?')">
                                    Xóa yêu cầu
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('admin.staff.rentals') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 