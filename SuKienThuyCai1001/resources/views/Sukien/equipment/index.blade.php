@extends('Sukien.layouts.noidung')

@section('content')
<div class="container py-5">
    <!-- Title Section -->
    <div class="col-12 mb-4">
        <h2 class="text-center mb-4">
            @if(isset($equipmentType))
                {{ $equipmentType->equipment_type_name }}
            @else
                Tất cả thiết bị
            @endif
        </h2>
    </div>

    <!-- Equipment Grid -->
    <div class="row g-4 mb-4">
        @foreach($equipment as $item)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card h-100 shadow-sm">
                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}" 
                         style="height: 200px; object-fit: cover;">
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                         style="height: 200px;">
                        <i class="fas fa-image fa-3x text-muted"></i>
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title" style="font-size: 1rem; min-height: 2.4rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                        {{ $item->name }}
                    </h5>
                    <p class="card-text text-primary fw-bold mb-3">
                        {{ number_format($item->price) }} VNĐ/ngày
                    </p>
                    <div class="mt-auto text-center">
                        <a href="{{ route('equipment.show', $item->id) }}" class="btn btn-primary w-100">
                            Thuê ngay
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $equipment->links() }}
    </div>
</div>

<style>
.card {
    transition: transform 0.3s ease;
    border: none;
    border-radius: 8px;
}

.card:hover {
    transform: translateY(-5px);
}

.card-img-top {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
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

/* Pagination Styles */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 2rem 0 0 0;
    padding: 0;
}

.page-item {
    list-style: none;
    margin: 0 3px;
}

.page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    border-radius: 4px;
    border: 1px solid #dee2e6;
    color: #3498db;
    text-decoration: none;
    padding: 0 10px;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    background-color: #fff;
}

.page-item.active .page-link {
    background-color: #3498db;
    border-color: #3498db;
    color: white;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

.page-link:hover:not(.disabled) {
    background-color: #e9ecef;
    color: #2980b9;
    border-color: #3498db;
    z-index: 2;
}
</style>
@endsection 