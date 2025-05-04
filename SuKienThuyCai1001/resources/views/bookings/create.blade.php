@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Đặt thuê thiết bị</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        <input type="hidden" name="equipment_id" value="{{ $equipment->equipment_id }}">

                        <!-- Thông tin người đặt -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Thông tin người đặt</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="user_name" class="form-label">Họ và tên</label>
                                        <input type="text" class="form-control" id="user_name" 
                                               value="{{ Session::get('user_name') }}" disabled>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="user_email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="user_email" 
                                               value="{{ Session::get('user_email') }}" disabled>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="user_phone" class="form-label">Số điện thoại</label>
                                        <input type="tel" class="form-control" id="user_phone" 
                                               value="{{ Session::get('user_phone') }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin thiết bị -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Thông tin thiết bị</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tên thiết bị</label>
                                        <input type="text" class="form-control" value="{{ $equipment->name }}" disabled>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Giá thuê/ngày</label>
                                        <input type="text" class="form-control" 
                                               value="{{ number_format($equipment->price, 0, ',', '.') }} VNĐ" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin đặt thuê -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">Ngày bắt đầu thuê</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                       id="start_date" name="start_date" min="{{ date('Y-m-d') }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">Ngày kết thúc thuê</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                       id="end_date" name="end_date" min="{{ date('Y-m-d') }}" required>
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="quantity" class="form-label">Số lượng</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                       id="quantity" name="quantity" min="1" value="1" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="payment_method" class="form-label">Phương thức thanh toán</label>
                                <select class="form-select @error('payment_method') is-invalid @enderror"
                                        id="payment_method" name="payment_method" required>
                                    <option value="">Chọn phương thức thanh toán</option>
                                    <option value="cash">Tiền mặt</option>
                                    <option value="bank_transfer">Chuyển khoản</option>
                                </select>
                                @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Ghi chú</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror"
                                      id="notes" name="notes" rows="3"></textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <h6 class="mb-2">Thông tin thanh toán</h6>
                            <p class="mb-1">Giá thuê/ngày: <span id="dailyPrice">{{ number_format($equipment->price, 0, ',', '.') }} VNĐ</span></p>
                            <p class="mb-1">Số ngày thuê: <span id="rentalDays">0</span> ngày</p>
                            <p class="mb-1">Số lượng: <span id="selectedQuantity">1</span></p>
                            <h5 class="mt-2">Tổng tiền: <span id="totalPrice">0</span> VNĐ</h5>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Xác nhận đặt thuê</button>
                            <a href="{{ route('equipment.show', ['equipment_id' => $equipment->equipment_id]) }}" class="btn btn-secondary">Quay lại</a>
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
    const dailyPrice = {{ $equipment->price }};
    const rentalDaysSpan = document.getElementById('rentalDays');
    const selectedQuantitySpan = document.getElementById('selectedQuantity');
    const totalPriceSpan = document.getElementById('totalPrice');

    function calculateTotal() {
        if (startDate.value && endDate.value) {
            const start = new Date(startDate.value);
            const end = new Date(endDate.value);
            const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
            const total = days * dailyPrice * parseInt(quantity.value);
            
            rentalDaysSpan.textContent = days;
            selectedQuantitySpan.textContent = quantity.value;
            totalPriceSpan.textContent = total.toLocaleString('vi-VN');
        }
    }

    startDate.addEventListener('change', calculateTotal);
    endDate.addEventListener('change', calculateTotal);
    quantity.addEventListener('change', calculateTotal);
});
</script>
@endpush
@endsection 