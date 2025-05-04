@extends('Sukien.layouts.noidung')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Thông tin chi tiết thiết bị -->
            <div class="card mb-4">
                <div class="card-body">
                    @if($equipment->image)
                        <img src="{{ asset('storage/' . $equipment->image) }}" 
                             class="img-fluid rounded mb-4" 
                             alt="{{ $equipment->name }}"
                             style="max-height: 500px; width: 100%; object-fit: contain; image-rendering: -webkit-optimize-contrast;">
                    @endif
                    
                    <h1 class="mb-4">{{ $equipment->name }}</h1>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="text-primary h4 mb-0">
                            {{ number_format($equipment->price) }} VNĐ/ngày
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge bg-info">
                                Số lượng: {{ $equipment->quantity }}
                            </span>
                            <span class="badge bg-{{ $equipment->status === 'available' ? 'success' : ($equipment->status === 'rented' ? 'danger' : 'warning') }}">
                                {{ $equipment->status === 'available' ? 'Có sẵn' : ($equipment->status === 'rented' ? 'Đã thuê' : 'Bảo trì') }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Mô tả</h5>
                        <p class="mb-0">{!! $equipment->description!!}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Thông tin sản phẩm</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Loại sản phẩm:</strong></p>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-secondary text-decoration-none">
                                        {{ $equipment->equipmentType->equipment_type_name }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Danh mục:</strong></p>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($equipment->categories as $category)
                                        <a href="{{ route('blog.category', $category->slug) }}" 
                                           class="badge bg-primary text-decoration-none">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($equipment->status === 'available')
                        <div class="mt-4">
                            <a href="{{ route('bookings.create', ['id' => $equipment->id]) }}" 
                               class="btn btn-primary btn-lg">
                                <i class="fas fa-calendar-check me-2"></i>Đặt thuê ngay
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Thiết bị liên quan -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thiết bị liên quan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($relatedEquipment as $related)
                            <div class="col-md-6 mb-4">
                                <a href="{{ route('equipment.show', $related->id) }}" class="text-decoration-none">
                                    <div class="card h-100">
                                        @if($related->image)
                                            <img src="{{ asset('storage/' . $related->image) }}" 
                                                 class="card-img-top" 
                                                 alt="{{ $related->name }}"
                                                 style="height: 200px; object-fit: cover;">
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $related->name }}</h5>
                                            <p class="card-text text-primary mb-0">
                                                {{ number_format($related->price) }} VNĐ/ngày
                                            </p>
                                            <span class="badge bg-{{ $related->status === 'available' ? 'success' : ($related->status === 'rented' ? 'danger' : 'warning') }}">
                                                {{ $related->status === 'available' ? 'Có sẵn' : ($related->status === 'rented' ? 'Đã thuê' : 'Bảo trì') }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Thông tin liên hệ -->
            <!-- Bài viết liên quan -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Bài viết liên quan</h5>
                </div>
                <div class="card-body">
                    @foreach($relatedBlogs as $blog)
                        <div class="mb-3">
                            <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none">
                                <div class="d-flex">
                                    @if($blog->image)
                                        <img src="{{ asset('storage/' . $blog->image) }}" 
                                             class="rounded me-3" 
                                             alt="{{ $blog->title }}"
                                             style="width: 80px; height: 60px; object-fit: cover;">
                                    @endif
                                    <div>
                                        <h6 class="mb-1">{{ $blog->title }}</h6>
                                        <small class="text-muted">{{ $blog->created_at->format('d/m/Y') }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 