@extends('Sukien.layouts.noidung')

@section('content')
<!-- Add Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="blog-container">
    <!-- Blog Header -->
    <div class="blog-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="blog-meta">
                        <a href="{{ route('blog.category', $blog->category->slug) }}" class="category">
                            {{ $blog->category->name }}
                        </a>
                        <span class="date">{{ $blog->created_at->format('d/m/Y') }}</span>
                    </div>
                    <h1 class="blog-title">{{ $blog->title }}</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Content -->
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8 mx-auto">
                @if($blog->image)
                <div class="blog-image">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                </div>
                @endif

                <div class="blog-content">
                    {!! $blog->content !!}
                </div>

                <!-- Related Equipment -->
                <div class="related-section">
                    <h3>Thiết bị cho thuê liên quan</h3>
                    <div class="slider-container">
                        <div class="staff-slider">
                            @foreach($sliderEquipment as $equipment)
                            <div class="staff-item">
                                @if(isset($equipment) && $equipment->image)
                                    <img src="{{ asset('storage/' . $equipment->image) }}" alt="{{ $equipment->name }}">
                                @else
                                    <div class="image-placeholder">
                                        <i class="fas fa-tools"></i>
                                    </div>
                                @endif
                                <div class="staff-info">
                                    <h4>{{ $equipment->name ?? 'Không có tên' }}</h4>
                                    <p>{{ number_format($equipment->price ?? 0) }} VNĐ/ngày</p>
                                    <a href="{{ route('equipment.show', $equipment->id) }}" class="btn-rent">Thuê ngay</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button class="slider-nav prev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
                        <button class="slider-nav next" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>

                <!-- Staff Section -->
                <div class="related-section">
                    <h3>Nhân sự cho thuê</h3>
                    <div class="slider-container">
                        <div class="staff-slider">
                            @foreach($staffs as $item)
                            <div class="staff-item">
                                @if(isset($item) && $item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                                @else
                                    <div class="image-placeholder">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                                <div class="staff-info">
                                    <h4>{{ $item->name ?? 'Không có tên' }}</h4>
                                    <p>{{ number_format($item->price ?? 0) }} VNĐ/ngày</p>
                                    <a href="{{ route('staff.rentals.create', $item->id) }}" class="btn-rent">Thuê ngay</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button class="slider-nav prev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
                        <button class="slider-nav next" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Related Posts -->
                <div class="sidebar-section">
                    <h4>Bài viết liên quan</h4>
                    <div class="related-posts">
                        @foreach($relatedBlogs as $related)
                        <a href="{{ route('blog.show', $related->slug) }}" class="related-post">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}">
                            @endif
                            <div class="post-info">
                                <h5>{{ $related->title }}</h5>
                                <span>{{ $related->created_at->format('d/m/Y') }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    {{ $relatedBlogs->links() }}
                </div>

                <!-- Related Equipment -->
                <div class="sidebar-section">
                    <h4>Thiết bị cho thuê</h4>
                    <div class="sidebar-equipment">
                        @foreach($relatedEquipment as $equipment)
                        <a href="{{ route('equipment.show', $equipment->id) }}" class="equipment-link">
                            @if($equipment->image)
                                <img src="{{ asset('storage/' . $equipment->image) }}" alt="{{ $equipment->name }}">
                            @endif
                            <div class="equipment-details">
                                <h5>{{ $equipment->name }}</h5>
                                <p>{{ number_format($equipment->price) }} VNĐ/ngày</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    {{ $relatedEquipment->links() }}
                </div>

                <!-- Staff List -->
                <div class="sidebar-section">
                    <h4>Nhân sự cho thuê</h4>
                    <div class="sidebar-staff">
                        @foreach($staffs as $staff)
                        <div class="staff-link">
                            @if($staff->image)
                                <img src="{{ asset('storage/' . $staff->image) }}" alt="{{ $staff->name }}">
                            @endif
                            <div class="staff-details">
                                <h5>{{ $staff->name }}</h5>
                                <p>{{ number_format($staff->price) }} VNĐ/ngày</p>
                                <a href="{{ route('staff.rentals.create', $staff->id) }}" class="btn-rent">Thuê ngay</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{ $staffs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.blog-container {
    background: #f8f9fa;
    padding: 2rem 0;
}

/* Header */
.blog-header {
    text-align: center;
    margin-bottom: 3rem;
}

.blog-meta {
    margin-bottom: 1rem;
}

.category {
    display: inline-block;
    background: #3498db;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    text-decoration: none;
    margin-right: 1rem;
}

.date {
    color: #666;
}

.blog-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
}

/* Content */
.blog-image {
    margin-bottom: 2rem;
}

.blog-image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 8px;
}

.blog-content {
    background: white;
    padding: 2rem;
    border-radius: 8px;
    margin-bottom: 3rem;
}

/* Related Sections */
.related-section {
    margin-bottom: 3rem;
}

.related-section h3 {
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #eee;
}

/* Slider Container */
.slider-container {
    position: relative;
    padding: 0 2.5rem;
    margin: 0 -0.5rem;
}

.staff-slider {
    display: flex;
    gap: 1rem;
    overflow: hidden;
    scroll-behavior: smooth;
}

.staff-item {
    flex: 0 0 calc(25% - 0.75rem);
    min-width: calc(25% - 0.75rem);
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    display: flex;
    flex-direction: column;
}

.staff-item:hover {
    transform: translateY(-5px);
}

.staff-item img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    flex-shrink: 0;
}

.staff-info {
    padding: 1rem;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    min-height: 120px;
    gap: 0.5rem;
}

.staff-info h4 {
    font-size: 0.9rem;
    margin: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    line-height: 1.2;
    min-height: 2.4em;
}

.staff-info p {
    font-size: 0.8rem;
    color: #3498db;
    margin: 0;
    font-weight: bold;
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

.slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: rgba(52, 152, 219, 0.9);
    border: none;
    color: white;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 2;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.slider-nav.prev {
    left: 0.5rem;
}

.slider-nav.next {
    right: 0.5rem;
}

.slider-nav:hover {
    background: rgba(41, 128, 185, 1);
    transform: translateY(-50%) scale(1.1);
}

.slider-nav i {
    font-size: 1rem;
    line-height: 1;
    width: auto;
    height: auto;
    display: inline-block;
    vertical-align: middle;
}

.slider-nav.prev i {
    margin-right: 2px;
}

.slider-nav.next i {
    margin-left: 2px;
}

/* Sidebar */
.sidebar-section {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.sidebar-section h4 {
    font-size: 1.2rem;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #eee;
}

/* Related Posts */
.related-posts {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.related-post {
    display: flex;
    gap: 1rem;
    text-decoration: none;
    color: inherit;
}

.related-post img {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 4px;
}

.post-info h5 {
    margin: 0 0 0.25rem;
    font-size: 0.9rem;
}

.post-info span {
    font-size: 0.8rem;
    color: #666;
}

/* Sidebar Equipment & Staff */
.sidebar-equipment,
.sidebar-staff {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.equipment-link,
.staff-link {
    display: flex;
    gap: 1rem;
    text-decoration: none;
    color: inherit;
}

.equipment-link img,
.staff-link img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 4px;
}

.equipment-details,
.staff-details {
    flex: 1;
}

.equipment-details h5,
.staff-details h5 {
    margin: 0 0 0.25rem;
    font-size: 0.9rem;
}

.equipment-details p,
.staff-details p {
    margin: 0;
    color: #3498db;
    font-size: 0.9rem;
}

/* Responsive */
@media (max-width: 991px) {
    .blog-title {
        font-size: 2rem;
    }

    .blog-image img {
        height: 300px;
    }

    .staff-item {
        flex: 0 0 calc(33.333% - 0.75rem);
        min-width: calc(33.333% - 0.75rem);
    }
}

@media (max-width: 767px) {
    .blog-meta {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .category {
        margin-right: 0;
    }

    .staff-item {
        flex: 0 0 calc(50% - 0.75rem);
        min-width: calc(50% - 0.75rem);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Staff Slider
    const staffSliders = document.querySelectorAll('.staff-slider');
    
    staffSliders.forEach(slider => {
        const prev = slider.parentElement.querySelector('.prev');
        const next = slider.parentElement.querySelector('.next');

        prev.addEventListener('click', () => {
            slider.scrollBy({
                left: -slider.offsetWidth,
                behavior: 'smooth'
            });
        });

        next.addEventListener('click', () => {
            slider.scrollBy({
                left: slider.offsetWidth,
                behavior: 'smooth'
            });
        });
    });
});
</script>
@endsection 