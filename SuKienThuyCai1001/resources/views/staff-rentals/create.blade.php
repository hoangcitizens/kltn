@extends('Sukien.layouts.noidung')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center">
                            @if($staff->image)
                                <img src="{{ asset('storage/' . $staff->image) }}" 
                                     class="img-fluid rounded mb-3" 
                                     alt="{{ $staff->name }}"
                                     style="max-height: 200px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/default-staff.jpg') }}" 
                                     class="img-fluid rounded mb-3" 
                                     alt="Default staff image"
                                     style="max-height: 200px; object-fit: cover;">
                            @endif
                        </div>
                        <div class="col-md-8 text-center text-md-start">
                            <h4 class="card-title mb-3">{{ $staff->name }}</h4>
                            <p class="card-text mb-2">
                                <strong>Số lượng hiện có:</strong> {{ $staff->quantity ?? 0 }}
                            </p>
                            <p class="card-text mb-2">
                                <strong>Giá thuê:</strong> {{ number_format($staff->price) }} VNĐ/ngày
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Thuê nhân sự</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('staff.rentals.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="staff_id" value="{{ $staff->id }}">

                        <div class="mb-3">
                            <label for="rental_date" class="form-label">Ngày thuê</label>
                            <input type="date" class="form-control" id="rental_date" name="rental_date" 
                                   value="{{ old('rental_date') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Số lượng</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" 
                                   value="{{ old('quantity', 1) }}" min="1" max="{{ $staff->quantity ?? 1 }}" required>
                            <small class="text-muted">Số lượng tối đa: {{ $staff->quantity ?? 0 }}</small>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Ghi chú</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tổng tiền</label>
                            <div class="h4 text-primary" id="total_price">0 VNĐ</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Gửi yêu cầu thuê</button>
                            <a href="{{ route('staff.index') }}" class="btn btn-secondary">Quay lại</a>
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
        const quantityInput = document.getElementById('quantity');
        const rentalDateInput = document.getElementById('rental_date');
        const totalPriceElement = document.getElementById('total_price');
        const staffPrice = {{ $staff->price }};

        function calculateTotalPrice() {
            const quantity = parseInt(quantityInput.value) || 0;
            const totalPrice = quantity * staffPrice;
            totalPriceElement.textContent = totalPrice.toLocaleString('vi-VN') + ' VNĐ';
        }

        quantityInput.addEventListener('input', calculateTotalPrice);
        rentalDateInput.addEventListener('change', calculateTotalPrice);

        // Tính tổng tiền ban đầu
        calculateTotalPrice();
    });
</script>
@endpush
@endsection 