@extends('Sukien.layouts.noidung')

@section('content')
<div class="container py-5">
    <!-- Staff Grid -->
    <div class="row g-4">
        @forelse($staffs as $staff)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card h-100 shadow-sm">
                @if($staff->image)
                    <img src="{{ asset('storage/' . $staff->image) }}" class="card-img-top" alt="{{ $staff->name }}" 
                         style="height: 250px; object-fit: cover;">
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                         style="height: 250px;">
                        <i class="fas fa-user fa-3x text-muted"></i>
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <div class="staff-type mb-2" style="text-align: center;">
                        <span class="badge bg-primary">{{ $staff->name }}</span>
                    </div>
                    <p class="card-text text-primary fw-bold mb-2" style="text-align: center;">
                        {{ number_format($staff->price) }} VNĐ/ngày
                    </p>
                    <div class="mt-auto text-center">
                    <a href="{{ route('staff.rentals.create', $staff->id) }}" class="btn-rent">Thuê ngay</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
            <h4>Không tìm thấy nhân sự phù hợp</h4>
            <p class="text-muted">Vui lòng thử lại với từ khóa khác hoặc bộ lọc khác</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $staffs->links() }}
    </div>
</div>

<style>
.card {
    transition: transform 0.3s ease;
    border: none;
    border-radius: 12px;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-5px);
}

.card-img-top {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

.staff-type .badge {
    font-size: 0.8rem;
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
}

.btn-primary {
    background-color: #3498db;
    border-color: #3498db;
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #2980b9;
    border-color: #2980b9;
    transform: translateY(-2px);
}

.btn-outline-primary {
    color: #3498db;
    border-color: #3498db;
}

.btn-outline-primary:hover {
    background-color: #3498db;
    color: white;
}

.pagination {
    gap: 0.5rem;
}

.page-link {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #3498db;
    border: 1px solid #dee2e6;
}

.page-item.active .page-link {
    background-color: #3498db;
    border-color: #3498db;
}

.page-link:hover {
    background-color: #e9ecef;
    color: #2980b9;
}

.card-text.small {
    font-size: 0.9rem;
}

.form-control {
    border-radius: 50px;
    padding: 0.5rem 1rem;
}

.form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
}

.dropdown-menu {
    border-radius: 12px;
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.dropdown-item {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    margin: 0.2rem;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
    color: #3498db;
}

.btn-rent {
display: block;
width: 120px;
margin: 0.5rem auto 0;
background: #3498db;
color: white;
padding: 0.5rem 1rem;
border-radius: 50px;
text-decoration: none;
transition: background 0.3s ease;
font-size: 0.8rem;
text-align: center;
}

.btn-rent:hover {
    background: #2980b9;
    color: white;
    text-decoration: none;
}

    
</style>
@endsection 