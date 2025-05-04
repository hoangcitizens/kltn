@extends('Sukien.layouts.noidung')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Thuê nhân sự: {{ $staff->name }}</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('staff.rentals.store', $staff->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Ngày bắt đầu</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" 
                                   value="{{ old('start_date') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" 
                                   value="{{ old('end_date') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Số lượng</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" 
                                   value="{{ old('quantity', 1) }}" min="1" max="{{ $staff->quantity }}" required>
                            <small class="text-muted">Số lượng còn lại: {{ $staff->quantity }}</small>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Ghi chú</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tổng tiền</label>
                            <div class="alert alert-info" id="total_price">
                                0 VNĐ
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');
        const quantity = document.getElementById('quantity');
        const totalPrice = document.getElementById('total_price');
        const pricePerDay = {{ $staff->price }};

        function calculateTotal() {
            if (startDate.value && endDate.value && quantity.value) {
                const start = new Date(startDate.value);
                const end = new Date(endDate.value);
                const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
                const total = pricePerDay * quantity.value * days;
                totalPrice.textContent = total.toLocaleString('vi-VN') + ' VNĐ';
            }
        }

        startDate.addEventListener('change', calculateTotal);
        endDate.addEventListener('change', calculateTotal);
        quantity.addEventListener('change', calculateTotal);
    });
</script>
@endpush
@endsection 