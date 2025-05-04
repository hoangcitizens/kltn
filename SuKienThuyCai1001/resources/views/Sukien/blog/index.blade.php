@extends('Sukien.layouts.noidung')

@section('content')
<div class="container py-5">
    <!-- Blog Grid -->
    <div class="row g-4">
        @forelse($blogs as $blog)
        <div class="col-lg-4 col-md-6">
            <div class="blog-card">
                <div class="blog-image">
                    @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid">
                    @else
                        <div class="no-image">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif
                    <div class="blog-category">
                        <a href="{{ route('blog.category', $blog->category->slug) }}" class="category-link">
                            {{ $blog->category->name }}
                        </a>
                    </div>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span class="date">
                            <i class="far fa-calendar-alt"></i>
                            {{ $blog->created_at->format('d/m/Y') }}
                        </span>
                        <span class="views">
                            <i class="far fa-eye"></i>
                            {{ $blog->views }} lượt xem
                        </span>
                    </div>
                    <h3 class="blog-title">
                        <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                    </h3>
                    <p class="blog-excerpt">{{ Str::limit(strip_tags($blog->content), 150) }}</p>
                    <div class="blog-footer">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="read-more">
                            Đọc thêm <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
            <h4>Chưa có bài viết nào</h4>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $blogs->links() }}
    </div>
</div>

<style>
.blog-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    height: 100%;
}

.blog-card:hover {
    transform: translateY(-5px);
}

.blog-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.blog-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.blog-card:hover .blog-image img {
    transform: scale(1.05);
}

.no-image {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    color: #6c757d;
    font-size: 3rem;
}

.blog-category {
    position: absolute;
    top: 15px;
    left: 15px;
}

.category-link {
    background: rgba(52, 152, 219, 0.9);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    text-decoration: none;
    transition: background 0.3s ease;
}

.category-link:hover {
    background: #2980b9;
    color: white;
}

.blog-content {
    padding: 1.5rem;
}

.blog-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    font-size: 0.85rem;
    color: #6c757d;
}

.blog-meta i {
    margin-right: 0.3rem;
}

.blog-title {
    font-size: 1.25rem;
    margin-bottom: 1rem;
    line-height: 1.4;
}

.blog-title a {
    color: #2c3e50;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-title a:hover {
    color: #3498db;
}

.blog-excerpt {
    color: #6c757d;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.blog-footer {
    border-top: 1px solid #eee;
    padding-top: 1rem;
}

.read-more {
    color: #3498db;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.read-more:hover {
    color: #2980b9;
}

.read-more i {
    margin-left: 0.3rem;
    transition: transform 0.3s ease;
}

.read-more:hover i {
    transform: translateX(3px);
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
</style>
@endsection 