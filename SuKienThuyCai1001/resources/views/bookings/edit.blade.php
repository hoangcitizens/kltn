@extends('Sukien.layouts.noidung')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Chỉnh sửa đơn đặt thuê</h4>
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

                    <form action="{{ route('bookings.update', $booking->booking_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Ngày bắt đầu</label>
                            <input type="datetime-local" class="form-control" id="start_date" name="start_date" 
                                   value="{{ old('start_date', date('Y-m-d\TH:i', strtotime($booking->start_date))) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">Ngày kết thúc</label>
                            <input type="datetime-local" class="form-control" id="end_date" name="end_date" 
                                   value="{{ old('end_date', date('Y-m-d\TH:i', strtotime($booking->end_date))) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Số lượng</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" 
                                   value="{{ old('quantity', $booking->quantity) }}" min="1" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <a href="{{ route('bookings.show', $booking->booking_id) }}" class="btn btn-secondary">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 