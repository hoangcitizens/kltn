@extends('Sukien.layouts.noidung')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">{{ $category->name }}</h1>
    
    <div class="row">
        @if($blogs->count() > 0)
            @foreach($blogs as $blog)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ Str::limit($blog->excerpt, 150) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">By {{ $blog->author->username ?? '' }}</small>
                                <small class="text-muted">{{ $blog->created_at->format('M d, Y') }}</small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-primary">Đọc thêm</a>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="d-flex justify-content-center mt-4">
                {{ $blogs->links() }}
            </div>
        @else
            <div class="col-12">
                <div class="alert alert-info">
                    Không tìm thấy bài viết nào trong danh mục này.
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
.card-img-top {
    height: 200px;
    object-fit: cover;
}
.card {
    transition: transform 0.3s;
}
.card:hover {
    transform: translateY(-5px);
}
</style>
@endsection 