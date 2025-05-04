@extends('Sukien.layouts.noidung')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Đặt thuê thiết bị</h4>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <h5>Thông tin thiết bị</h5>
                        <div class="row">
                            <div class="col-md-4">
                                @if($equipment->image)
                                    <img src="{{ asset('storage/' . $equipment->image) }}" 
                                         class="img-fluid rounded" 
                                         alt="{{ $equipment->name }}">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h6>{{ $equipment->name }}</h6>
                                <p class="text-primary mb-0">
                                    {{ number_format($equipment->price) }} VNĐ/ngày
                                </p>
                                <p class="mb-0">
                                    Số lượng còn lại: {{ $equipment->quantity }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        <input type="hidden" name="equipment_id" value="{{ $equipment->id }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">Ngày bắt đầu</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                       id="start_date" name="start_date" 
                                       min="{{ date('Y-m-d') }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">Ngày kết thúc</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                       id="end_date" name="end_date" required>
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Số lượng</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                   id="quantity" name="quantity" 
                                   min="1" max="{{ $equipment->quantity }}" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Xác nhận đặt thuê</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin liên hệ</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6>Địa chỉ</h6>
                        <p class="mb-0">123 Đường ABC, Quận XYZ, TP.HCM</p>
                    </div>
                    <div class="mb-3">
                        <h6>Điện thoại</h6>
                        <p class="mb-0">0123 456 789</p>
                    </div>
                    <div class="mb-3">
                        <h6>Email</h6>
                        <p class="mb-0">info@example.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('start_date').addEventListener('change', function() {
        document.getElementById('end_date').min = this.value;
    });
</script>
@endpush
@endsection 